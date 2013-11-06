<?php $data = $userData->getPersonalData(); ?>
<section style="float: left; width:800px">
    <h2>User settings</h2>
    <form>
        <div class="col-left">
            <section  class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">Dropbox account</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>Dropbox email</td> <td><input type="text" name="dropboxEmail" value ="<?php echo $data["dropboxEmail"] ?>"></td>
                        </tr>
                    </table>
                </div>

            </section>
            
            <section class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Security settings</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td>Email</td> <td><?php echo $data["loginEmail"] ?></td>
                        </tr>
                        <tr>
                            <td>Password</td> <td><a href="#">change password</a></td>
                        </tr>
                    </table>
                </div>
            </section>

            <section class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Personal settings</h3>
                </div>
                <div class="panel-body">
                    <table>
                        <table>
                            <tr>
                                <td>Name</td> <td><input type="text" name="userName" autocomplete="on" value ="<?php echo $data["name"] ?>"></td >
                            </tr>
                            <tr>
                                <td>Surname</td> <td><input type="text" name="userSurname" autocomplete="on" value ="<?php echo $data["surname"] ?>"></td >
                            </tr>
            <!--                <tr>
                                <td>Adres e-mail</td><td><input type="email" name="userMail" autocomplete="on" required
                                                                pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$"
                                                                value="<?php echo $data["email"] ?>"></td>
                            </tr>-->
                            <tr>
                                <td>Gender</td> <td></td>
                            </tr>
                            <tr>
                                <?php
                                if ($data["gender"] == "M") {
                                    echo '<td><input type="radio" name="userSex" id="userFamale" value="M" checked>Male</td>     
                              <td><input type="radio" name="userSex" id="userMale" value="F">Female</td>   ';
                                } else {
                                    echo '<td><input type="radio" name="userSex" id="userFamale" value="M">Male</td>     
                              <td><input type="radio" name="userSex" id="userMale" value="F" checked>Female</td>   ';
                                }
                                ?>

                            </tr>
                            <tr>
                                <td>City</td><td> <input type="text" name="city" value ="<?php echo $data["city"] ?>"></td>
                            </tr>
                            <tr>
                                <td>Birth date</td><td><input type="date" name="birthDate" value ="<?php echo date_format($data["birthDate"], 'Y-m-d'); ?>"></td> 
                            </tr>
                        </table>
                </div>
            </section>
        </div>
        <div class="col-left">
             <figure class="image-div">
        <img src="<?php echo $data["avatar"] ?>" class="img-thumbnail"  alt="No image found"/>
        <form action="" method="post" enctype="multipart/form-data">
            <div style=" margin: 0 auto;" class="upload">
                <input type="file" name="Change"/>
            </div>
        </form>
    </figure>
            <div id="changeButtons">
        <input type="submit" class="btn btn-lg btn-primary" name="action" value="Change settings" >
        <input type="reset" class="btn btn-lg btn-primary" value="Cancel changes" class="freshbutton">
        </div>
        </div>
    </form>
</section>
