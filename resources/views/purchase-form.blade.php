<!DOCTYPE html>
<html lang="en">
<head>
    <title>Purchase Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }
        .grid-item {
            padding: 10px;
        }
        .add-row-button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-row-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Invoice Number: {{$invoice}}</h1>

    <form action="{{  route('purchases.store') }}" method="POST"id="purchase_form">
    <button type="submit">Save</button>

        @csrf
<h1>
</h1>
        <!-- Initial Purchase Row -->
        <div class="purchase-row grid-container">
            <div class="grid-item">
                <label for="category">Category:</label>
                <select name="category[]" onchange="updateCodes(this)">
                    <option value=""></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['value'] }}">{{ $category['label'] }}</option>
                    @endforeach
                </select>                            
            </div>
            <div class="grid-item">
                <label for="item_code">Code:</label>
                <select name="item_code[]">
                <option value=""></option>
                    
                </select>
            </div>
            <div class="grid-item">
                <label for="description">Description:</label>
                <input type="text" name="description[]" readonly>
            </div>
            <div class="grid-item">
                <label for="units">Units:</label>
                <input type="text" name="units[]" readonly>
            </div>
            <div class="grid-item">
                <label for="quantity">Qty:</label>
                <input type="number" name="quantity[]" min="0" value=0>
            </div>
            <div class="grid-item">
                <label for="price">Price/Unit:</label>
                <input type="number" name="price[]" min="0" value = 0>
            </div>
            <div class="grid-item">
                <label for="vat_code">GST %:</label>
                <select name="vat_code[]"   >
                    <option value=""></option>
                    @foreach ($GST as $gst)
                        <option value="{{ $gst['label'] }}">{{ $gst['label'] }}</option>
                    @endforeach
                </select>                 
            </div>

            <div class="grid-item">
                <label for="discount">Discount:</label>
                <input type="number" name="discount[]" min="0" value = 0>
                <select name="discount_type[]">
                    <option value="%">%</option>
                    <option value="amount">Amount</option>
                </select>
            </div>
            <div class="grid-item">
                <label for="basic_amount" >Basic Amount:</label>
                <input type="text" name="basic_amount[]" value="0" readonly>
            </div>
            <div class="grid-item">
                <label for="total_price" >Total Price:</label>
                <input type="text" name="total_price[]" value="0" readonly>
            </div>
        </div>

    </form>

    <!-- Plus button for adding new row -->
    <button id="add_row" class="add-row-button">+</button>

    <script>
        document.getElementById('add_row').addEventListener('click', function() {
            // Clone the template row
            var newRow = document.querySelector('.purchase-row.template').cloneNode(true);
            newRow.classList.remove('template'); // Remove the template class
            var addButton = document.getElementById('add_row');
            addButton.parentNode.insertBefore(newRow, addButton);
        });
    </script>
    
</body>
</html>


<script>
    function updateCodes(categorySelect) {
        var categoryId = categorySelect.value;
        var codeSelect = categorySelect.parentElement.nextElementSibling.querySelector('select[name="item_code[]"]');
        var descriptionInput = codeSelect.parentElement.nextElementSibling.querySelector('input[name="description[]"]');
        var unitsInput = descriptionInput.parentElement.nextElementSibling.querySelector('input[name="units[]"]');
        
        // Clear existing options
        codeSelect.innerHTML = '';

        // Get the codes for the selected category from the passed data
        var categoryCodes = {!! json_encode($categoryCodes) !!};
        console.log(categoryCodes, categoryId,  categoryCodes[categoryId]);
        var codes = categoryCodes[categoryId] || [];

        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Select';
        codeSelect.appendChild(defaultOption);

        // Populate options for the code select element
        for (var key in codes) {
            var option = document.createElement('option');
            option.value = key;
            option.text = codes[key];
            codeSelect.appendChild(option);
        }

        // Handle code selection
        codeSelect.addEventListener('change', function() {
            var selectedCode = this.value;
            // Retrieve details for the selected code from the controller data (codeDetails)
            var codeDetails = {!! json_encode($codeDetails) !!};
            var selectedCodeDetails = codeDetails[selectedCode];
            // Update description and units fields
            descriptionInput.value = selectedCodeDetails.description;
            unitsInput.value = selectedCodeDetails.units;
        });
    }

    
</script>



<script>
    // Function to calculate Basic Amount and Total Price
    function calculateAmounts(row) {
        var quantity = parseFloat(row.querySelector('input[name="quantity[]"]').value);
        var price = parseFloat(row.querySelector('input[name="price[]"]').value);
        var vatCodeSelect = row.querySelector('select[name="vat_code[]"]');
        var gst = 0;

        if (vatCodeSelect && vatCodeSelect.value) {
            gst = ((quantity * price) * vatCodeSelect.value);
        }
        var discountType = row.querySelector('select[name="discount_type[]"]').value;
        var discount = parseFloat(row.querySelector('input[name="discount[]"]').value);
        
        // Calculate Basic Amount
        var basicAmount = quantity * price + gst;

        // Calculate Total Price
        var totalPrice = basicAmount - (discountType === '%' ? (basicAmount * (discount / 100)) : discount);

        return { basicAmount: basicAmount, totalPrice: totalPrice };
    }

    // Function to update Basic Amount and Total Price
    function updateAmounts(row) {
        var amounts = calculateAmounts(row);
        row.querySelector('input[name="basic_amount[]"]').value = amounts.basicAmount.toFixed(2);
        row.querySelector('input[name="total_price[]"]').value = amounts.totalPrice.toFixed(2);
    }

    // Event listener for dynamic inputs using event delegation
    document.addEventListener('change', function(event) {
        if (event.target.matches('input[name="quantity[]"], input[name="price[]"], input[name="discount[]"], select[name="vat_code[]"], select[name="discount_type[]"]')) {
            var row = event.target.closest('.purchase-row');
            updateAmounts(row);
        }
    });

    // Event listener for adding new rows
    document.getElementById('add_row').addEventListener('click', function() {
        var newRow = document.querySelector('.purchase-row').cloneNode(true);
        var addButton = document.getElementById('add_row');
        addButton.parentNode.insertBefore(newRow, addButton);
    });
</script>
