<div class="container user">
    <div class="row">
        <div class="col order-md-2 p-1 d-flex justify-content-end">
            <div class="container-fluid">
                <div class="row p-2 text-center" id="button-container">
                    <div>
                        <button type="button" class="btn btn-secondary" id="history"
                                onclick="showHistory('<?php echo $_SESSION["email"]; ?>')">História prihlásení
                        </button>
                    </div>
                </div>
                <div class="row p-2 text-center">
                    <a href="/authentication/api/logout.php">
                        <button type="button" class="btn btn-secondary">Odhlásiť sa</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col order-md-1 d-flex p-1">
            <div>
                <img src="/authentication/assets/img/user.png" alt="user-icon" class="img-fluid image">
            </div>
            <div>
                <div class="text-center">
                    <h3>
                        <?php echo $_SESSION["name"] . ' ' . $_SESSION["surname"]; ?>
                    </h3>
                </div>
                <div class="d-flex">
                    <ul class="m-2 vertical" style="float: left; margin-right: 0; padding-right: 1em">
                        <li class="mt-2">Email:</li>
                        <li class="mt-2">Typ prihlásenia:</li>
                    </ul>
                    <ul class="m-2">
                        <li class="mt-2"><?php echo $_SESSION["email"]; ?></li>
                        <li class="mt-2"><?php echo $_SESSION["type"]; ?></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div id="history-table" style="visibility: hidden">
            <table class="table table-bordered table-striped" >
                <thead>
                <tr class="table-head">
                    <th scope="col">Email</th>
                    <th scope="col">Čas prihlásenia</th>
                    <th scope="col">Typ prihlásenia</th>
                </tr>
                </thead>
                <tbody id="history-table-body">
                </tbody>
            </table>
        </div>
    </div>
</div>
