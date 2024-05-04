<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="welcome-message">
    <img src="mariage.jpeg" alt="absence de l image" height="5%" while="5%">
        <h1>Welcome! voulez vous faire partir du mariage de X </h1>
        <button class="btn btn-primary" id="yesBtn">Yes</button>
        <button class="btn btn-secondary" id="noBtn">No</button>
    </div>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="myForm">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#yesBtn").click(function(){
        $("#myModal").css("display", "block");
    });
    
    $("#noBtn").click(function(){
        window.close();
    });

    $(".close").click(function(){
        $("#myModal").css("display", "none");
    });

    $("#myForm").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: "save_data.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                // Parsez la réponse JSON
                response = JSON.parse(response);
                if (response.success) {
                    Swal.fire({
                        title: 'Confirmer votre présence',
                        text: response.message,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui',
                        cancelButtonText: 'Non'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'update.php',
                                type: 'POST',
                                data: { email: response.email },
                                success: function(updateResponse){
                                    Swal.fire('Présence confirmée!', updateResponse.message, 'success');
                                },
                                error: function(){
                                    Swal.fire('Erreur', 'Une erreur est survenue lors de la mise à jour.', 'error');
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: response.message
                    });
                }
            },
            error: function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Une erreur est survenue lors de la requête AJAX.'
                });
            }
        });
    });
});
</script>

</body>
</html>
