<?php
    require "reportFun.php";

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $date = $_POST['date'];
        $description = $_POST['description'];
        $traceability = $_POST['traceability'];

        $result = addIncident(date: $date, description: $description, traceability: $traceability);
        if($result){
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Incident Registered.</span></div>";
        } else {
            echo "<div class='div-msg' id='success-msg'><span class='msg'>Error</span></div>";
        }
    }
?>

    <main class="forms">
        <div class="background">
            <form class="form" action="?a=add" method="post" autocomplete="off">
                <header class="header">
                    <img src="<?php  echo SVG . "icon.svg" ?>">
                    <h1>Add Report</h1>
                </header>
                <hr>
                <h2>Incident</h2>
                <div class="rows">
                    <div class="row-md-5">
                        <h4>Date</h4>
                        <div class="inputs">
                            <input type="date" required placeholder="">
                        </div>
                    </div>
                    <div class="row-md-5">
                        <h4>Trazability</h4>
                        <div class="inputs">
                            <input type="text" required placeholder="">
                        </div>
                    </div>
                    <div class="row-lg-12">
                        <h4>Description</h4>
                        <div class="inputs">
                            <textarea type="text" required placeholder="" ></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <footer class="footer">
                    <button class="btn-primary" type="submit">Confirm Registration</button>
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