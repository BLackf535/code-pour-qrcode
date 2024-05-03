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
        <h1>Welcome!</h1>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    if (response.includes("email existe déjà")) {
                        // Affiche un SweetAlert avec un logo danger
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response
                        });
                    } else {
                        // Affiche un SweetAlert avec un logo succès
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response
                           
                        });
                        // Ferme la fenêtre après 2 secondes si la réponse contient "succès"
                         window.setTimeout(function() { window.close(); }, 2000);
                         setTimeout(function() { window.close(); }, 2000);

                          // Gestionnaire d'événements pour écouter les messages envoyés par la fenêtre enfant
                            window.addEventListener('message', function(event) {
                                if (event.data === 'close') {
                                    // Ferme la fenêtre parente
                                    window.close();
                                }
                            });
                    }
                },
                error: function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        });
    });
</script>


</body>
</html>
