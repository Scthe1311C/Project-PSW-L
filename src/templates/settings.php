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
                            <td style="width: 150px">Upload photos</td> <td style="width: 200px"><a style="width: 100%" id="browse" class="btn btn-large btn-primary" href="">Upload</a></td>
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
                            <td>Email</td> <td><?php echo $user->email?></td>
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
                                <td>Name</td> <td><input type="text" name="userName" autocomplete="on" value ="<?php echo $user->name ?>"></td >
                            </tr>
                            <tr>
                                <td>Surname</td> <td><input type="text" name="userSurname" autocomplete="on" value ="<?php echo $user->surname ?>"></td >
                            </tr>
                            <tr>
                                <td>Gender</td> <td></td>
                            </tr>
                            <tr>
                                <?php
                                if ($user->gender == "M") {
                                    echo '<td><input type="radio" name="userSex" id="userFamale" value="M" checked>Male</td>'
                                        .'<td><input type="radio" name="userSex" id="userMale" value="F">Female</td>   ';
                                } else {
                                    echo '<td><input type="radio" name="userSex" id="userFamale" value="M">Male</td>     '
                                        . '<td><input type="radio" name="userSex" id="userMale" value="F" checked>Female</td>   ';
                                }
                                ?>

                            </tr>
                            <tr>
                                <td>City</td><td> <input type="text" name="city" value ="<?php echo $user->address->city ?>"></td>
                            </tr>
                            <tr>
                                <td>Birth date</td><td><input type="date" name="birthDate" value ="<?php echo $user->birth_date; ?>"></td> 
                            </tr>
                        </table>
                </div>
            </section>
        </div>
        <div class="col-left">
            <figure class="image-div">
                <img src="<?php echo $user->avatar ?>" class="img-thumbnail"  alt="No image found"/>
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
