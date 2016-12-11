<body class="page-login">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                            <div class="login-box">
                                <a href="index.html" class="logo-name text-lg text-center">Administration</a>
                                <p class="text-center m-t-md">Please login into your account.</p>
                                
                                <form class="m-t-md" action="<?php echo base_url(); ?>admin.php/dashboard/index" method="post">
                                
                                	<div class="form-group">
                                        <input type="username" name="username" id="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <input type="submit" name="ok" value="Login" class="btn btn-success btn-block">
                                </form>
                                <span class=error>
                                <?php
                                    echo validation_errors();
                                    if($error!="")
                                     	echo $error;
								?>
                                </span>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
</body>
</html>