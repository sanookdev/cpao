<section class="parthner">

    <div class="container">

        <h3 style="text-align:center;border-bottom:solid 0px #fff">หน่วยงานที่เกี่ยวข้อง</h3>

        <div class="row" style="padding-top: 10px;">

            <div class=" col-md-12 col-sm-12 col-xs-12 ">



                <div class="box">

                    <?php

                    foreach ($partner as $row) {

                        echo '<div class="col-md-4 col-sm-4 col-xs-6">

                            <a title="' . $row['setting_value3'] . '" href="' . $row['setting_value2'] . '" target="_blank" class="card thumbnail "><img src="' . base_url('/uploads/' . $row['setting_value']) . '" alt="' . $row['setting_value3'] . '"></a>

                        </div>';

                    }

                    ?>

                    <div style="clear:both"></div>

                </div>

                <!--.row-->



            </div>

        </div>

    </div>

</section>