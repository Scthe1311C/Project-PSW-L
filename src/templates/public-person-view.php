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
                    <a href="#"  class="glyphicon glyphicon-heart" title="Add to favourite"></a>
                    <a href="#"  class="glyphicon glyphicon-plus-sign" title="Add to friends"></a>
                    <a href="#"  class="glyphicon glyphicon-envelope" title="Send "></a>
                </h3>             
            </div>

            <div class="panel-body">
                <table>
                    <table>
                        <tr>
                            <td>Name</td> <td><?php echo $person->name ?></td >
                        </tr>
                        <tr>
                            <td>Surname</td> <td><?php echo $person->surname ?></td >
                        </tr>
                        <tr>
                            <td>Gender</td> 
                            <td>
                                <?php
                                //if user define gender
                                if ($person->gender != NULL) {
                                    if ($person->gender == "M") {
                                        echo "Male";
                                    } else {
                                        echo "Famale";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td><td><?php echo $person->city ?></td>
                        </tr>
                        <tr>
                            <td>Birth date</td><td><?php echo $person->birth_date; ?></td> 
                        </tr>
                    </table>
            </div>
        </section>
    </div>

    <div class="col-left">
        <figure class="image-div">
            <img src="<?php echo $person->avatar ?>" class="img-thumbnail"  alt="No image found"/>
        </figure> 
    </div>
</section>
