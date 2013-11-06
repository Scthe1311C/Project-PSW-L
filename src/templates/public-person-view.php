<!--<ul id="breadcrumb">
    <li>Profile info</li>
    <li>Galleries</li>
</ul>-->
<?php $data = $personData->getPersonalData(); ?>

<div class="masthead">
    <ul style="
        padding-bottom: 20px;
        width: 80%;
        font-size: smaller;"
        
        class="nav nav-justified">
        <li style="width: 0%" class="active"><a href="#">Personal info</a></li>
        <li style="width: 0%"><a href="#">Galeries</a></li>
        <li style="width: 0%"><a href="#">Favorites</a></li>
    </ul>
</div>
<section style="float: left; width:800px">
    <div class="col-left">
        <section style="height: 300px" class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Personal info
                    <a href="#"  class="glyphicon glyphicon-heart" title="Add to friends"></a>
                    <a href="#"  class="glyphicon glyphicon-plus-sign" title="Add to friends"></a>
                    <a href="#"  class="glyphicon glyphicon-envelope" title="Send "></a>
                </h3>             
            </div>
            <div class="panel-body">
                <table>
                    <table>
                        <tr>
                            <td>Name</td> <td><?php echo $data["name"] ?></td >
                        </tr>
                        <tr>
                            <td>Surname</td> <td><?php echo $data["surname"] ?>"</td >
                        </tr>
        <!--                <tr>
                            <td>Adres e-mail</td><td><input type="email" name="userMail" autocomplete="on" required
                                                            pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$"
                                                            value="<?php echo $data["email"] ?>"></td>
                        </tr>-->
                        <tr>
                            <td>Gender</td> 
                            <td>
                                <?php
                                if ($data["gender"] == "M") {
                                    echo "Male";
                                } else {
                                    echo "Famale";
                                }
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <td>City</td><td><?php echo $data["city"] ?></td>
                        </tr>
                        <tr>
                            <td>Birth date</td><td><?php echo date_format($data["birthDate"], 'Y-m-d'); ?></td> 
                        </tr>
                    </table>
            </div>
        </section>
    </div>
    <div class="col-left">
        <figure class="image-div">
            <img src="<?php echo $data["avatar"] ?>" class="img-thumbnail"  alt="No image found"/>
        </figure> 
        

    </div>
</section>
