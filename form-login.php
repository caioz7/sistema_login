<?php require_once './assets/header.php'; ?>
    <h1 class="text-center">LOGIN</h1>
    <form action="login.php" method="post">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="row">
                    <div class="col col-sm">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">    
                    </div>
                </div>
                <div class="row mt-3 mb-4">
                    <div class="col col-sm">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Senha">    
                    </div>
                </div>        
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="row justify-content-between">
                    <div class="col">
                        <a class="btn btn-outline-danger" href="../sistema_login/" role="button">VOLTAR</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary float-right">ACESSAR</button>    
                    </div>
                </div>
            </div>    
        </div>
        
    </form>
 <?php require_once './assets/footer.php'; ?>