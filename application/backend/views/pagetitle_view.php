				<div class="page-title">
                    <h3>Dashboard</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                        <?php
                            
							foreach($p as $key => $value)
							{
								echo"<li><a href=\"$value\">$key</a></li>";
							}

						?>
                        </ol>
                    </div>
                </div>
                