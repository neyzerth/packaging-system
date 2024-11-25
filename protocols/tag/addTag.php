<?php
    if(!validateUser("ADMIN","SUPER")){
        header("Location: /tag/");//verificar desde donde es
        exit;
    }
    require "tagFun.php";
    
    $tag_types = getTagTypes();

    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $date = $_POST['date'];
        $tag_type = $_POST['tag_type'];
        $destination = $_POST['destination'];

        $result = addTag(
            date: $date, tag_type:$tag_type, destination:$destination
        );
        if ($result) {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Tag added successfully</span></div>";
        } else {
            echo "<div class='div-msg' id='error-msg'><span class='msg'>Error adding tag</span></div>";
        }
    }
?>
<script src="tagForm.js"></script>

<main class="forms">
    
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Tags</h1>
            </header>
            <h2>Tag</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="date">Date</h4>
                    <div class="inputs">
                        <input name="date" id="date" type="date" required>
                    </div>
                </div>

                <div class="row-md-5">
                    <h4 for="unit_of_measure">Tag Type</h4>
                    <div class="inputs">
                        <select class="input" required name="tag_type" id="tag_type options">
                            <?php 
                                while ($tag_type = mysqli_fetch_assoc($tag_types)):   
                                    echo "<option value='{$tag_type['code']}'>{$tag_type['description']}</option>";
                                endwhile; 
                            ?>
                        </select>
                    </div>
                </div>


                <div class="row-md-5">
                    <h4 for="destination">Destination</h4>
                    <div class="inputs">
                        <input name="destination" id="destination" type="text" placeholder="Cuba" required>
                    </div>
                </div>
            </div>
            <hr>
            <footer class="footer">
                <button class="btn-primary" type="submit">Confirm</button>
            </footer>
        </form>
    </div>
</main>
<script>
        setTimeout(() => {
            const successMsg = document.getElementById('success-msg');
            const errorMsg = document.getElementById('error-msg');
            if (successMsg) successMsg.style.display = 'none';
            if (errorMsg) errorMsg.style.display = 'none';
        }, 3000);
    </script>