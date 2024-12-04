<?php
    if(!validateUser("ADMIN","SUPER")){
        header("Location: /tagType/");//verificar desde donde es
        exit;
    }
    require "tagTypeFun.php";

    if ($_SERVER['REQUEST_METHOD']=='POST') {

        $code = $_POST['code'];
        $description = $_POST['description'];

        $result = addTagType(
            code: $code, description:$description
        );

        if ($result) {
            $_SESSION['message'] = [
                'text' => 'Tag type added successfully',
                'type' => 'success'
            ];
        } else {
            $_SESSION['message'] = [
                'text' => 'Error adding new tag type',
                'type' => 'error'
            ];
        }
        header("Location: /protocols/tagType/");
        exit();
    }
?>
<script src="tagTypeForm.js"></script>

<main class="forms">
    
    <div class="background">
        <form class="form" action="" method="post" autocomplete="off">
            <header class="header">
                <img src="<?php  echo SVG . "icon.svg" ?>">
                <h1>Add tag types</h1>
            </header>
            <hr>
            <h2>Tag type</h2>
            <div class="rows">
                <div class="row-sm-3">
                    <h4 for="code">Code</h4>
                    <div class="inputs">
                        <input name="code" id="code" type="text" required maxlength="5">
                    </div>
                </div>

                <div class="row-md-5">
                    <h4 for="destination">Description</h4>
                    <div class="inputs">
                        <input name="description" id="description" type="text" placeholder="Heavy" required maxlength="50">
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