<!DOCTYPE html>
<html>
<head>
    <title>Fetch FROM DATABASE and AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="temp-desplay"></script>

    <script>
        $(document).ready(function(){
            setInterval(ajaxcall, 1000);
        });

        function ajaxcall(){
            $.ajax({
                type: 'POST',
                url: 'temp-fetch.php',
                success: function(data) {
                    $('#UID').val(data); // Set the value of the input field to the received UID
                }
            });
        }
    </script>
</head>

<body>
    <center>
        <div>
            <label for="UID">UID:</label>
            <input type="text" id="UID" name="UID" readonly><br><br>
            
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname"><br><br>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname"><br><br>

            <button onclick="submitData()">Submit</button>
        </div>
        <br>
        
    </center>

    <script>
        function submitData() {
            var UID = $("#UID").val();
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();

            $.ajax({
                type: 'POST',
                url: 'temp-fetch.php',
                data: { UID: UID, firstname: firstname, lastname: lastname },
                success: function(data) {
                    $('#UID').val(data);
                }
            });
        }
    </script>
</body>
</html>
