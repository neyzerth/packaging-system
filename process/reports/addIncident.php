<?php
    require("../../config.php");
    require HEAD;
    require "reportFun.php";

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $date = $_POST['date'];
        $description = $_POST['description'];
        $traceability = $_POST['traceability'];

        $result = addIncident(date: $date, description: $description, traceability: $traceability);
    }
?>
                    <form action="addIncident.php" method="post" autocomplete="off">
                        <h2>Incident</h2>
                        <div class="row-form">
                            <div class="row-lg-12">
                                <label for="">Date</label>
                                <div class="input-group">
                                    <input type="date" required placeholder="">
                                </div>
                            </div>
                            <div class="row-lg-12">
                                <label for="">Description</label>
                                <div class="input-group">
                                    <textarea type="text" required placeholder="" ></textarea>
                                </div>
                            </div>
                            <div class="row-lg-12">
                                <label for="">Trazability</label>
                                <div class="input-group">
                                    <input type="text" required placeholder="">
                                </div>
                            </div>
                        </div>
                        <hr class="border-bottom" style="margin-top: 2rem; margin-bottom: 2rem;">
                        <button class="btn-primary" type="submit">Confirm Registration</button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="text-center" style="margin-top: 3rem; padding-top: 3rem; margin-bottom: 3rem;">
            <p>© 2024-2025 Company Name</p>
        </footer>
    </div>
</body>

</html>