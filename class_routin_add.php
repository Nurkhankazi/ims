<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0">Your school dashboard</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="class_routine_add.php">Class routine</a></li>
                            <li class="breadcrumb-item active"><a href="class_routine_list.php">Class routine</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
           
            <form method="post" action="">
                 <div class="row">
                    <div class="col-lg-3">
                        <label for="class_id">Class</label>
                        <select class="form-control" id="class_id" name="class_id">
                            <option value="">Select Class</option>
                            <?php 
                                $result=$mysqli->common_select('class');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $d){
                            ?>
                            <option value="<?= $d->id ?>"><?= $d->class ?> </option>
                            <?php } } } ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="class_id">Section</label>
                        <select class="form-control" id="section_id" name="section_id">
                            <option value="">Select Section</option>
                            <?php 
                                $result=$mysqli->common_select('section');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $d){
                            ?>
                            <option value="<?= $d->id ?>"><?= $d->section ?> </option>
                            <?php } } } ?>
                        </select>
                    </div>
                    
                    <div class="col-lg-3">
                        <label for="group_id">Session</label>
                        <select class="form-control" id="session_id" name="session_id">
                            <option value="">Select Session </option>
                            <?php 
                                $result=$mysqli->common_select('session');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $d){
                            ?>
                            <option value="<?= $d->id ?>"><?= $d->session ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="day_name">Day </label>
                        <select class="form-control" id="day_name" name="day_name">
                            <option value="">Select Day </option>
                            <?php 
                                $result=$mysqli->common_select('Day_name');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $d){
                            ?>
                            <option value="<?= $d->sl ?>"><?= $d->day_name ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                </div>
            <?php 
                $result=$mysqli->common_select('period');
                if($result){
                    if($result['data']){
                        $i=1;
                        foreach($result['data'] as $d){
            ?>

                <div class="row mt-4">
                    <div class=""col-lg-3>
                        <?= $d->period_name ?> (<?= $d->period_time ?>)
                        <input type="hidden" name="period_id[<?= $d->sl ?>]" value="<?= $d->sl ?>">
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="subject_name[<?= $d->sl ?>]">
                            <option value="">Select Subject</option>
                            <?php 
                                $result=$mysqli->common_select('subject');
                                if($result){
                                    if($result['data']){
                                        $i=1;
                                        foreach($result['data'] as $sub){
                            ?>
                            <option value="<?= $sub->id ?>"><?= $sub->subject_name ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="teacher_name[<?= $d->sl ?>]">
                            <option value="">Select Teacher</option>
                            <?php 
                                $result=$mysqli->common_select('teacher');
                                if($result){
                                    if($result['data']){
                                        foreach($result['data'] as $teach){
                            ?>
                            <option value="<?= $teach->id ?>"><?= $teach->name ?></option>
                            <?php } } } ?>
                        </select>
                    </div>
                </div>
            <?php } } } ?>
                

            
                    
                <div class="col-lg-10 justify-content-end mt-2 pt-3 mt-sm-0 d-flex">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <?php 
        if($_POST){
            if($_POST['period_id']){
                foreach($_POST['period_id'] as $p){
                    $stu['class_id']=$_POST['class_id'];
                    $stu['section_id']=$_POST['section_id'];
                    $stu['session_id']=$_POST['session_id'];
                    $stu['day_name']=$_POST['day_name'];
                    $stu['period']=$p;
                    $stu['subject_name']=$_POST['subject_name'][$p];
                    $stu['teacher_id']=$_POST['teacher_name'][$p];
                    $stu['created_at']=date('Y-m-d H:i:s');
                    $stu['created_by']=1;
                    $rs=$mysqli->common_create('Class_routine',$stu);
                }
                if($rs){
                    if($rs['data']){
                        echo "<script>window.location='{$baseurl}class_routine_list.php'</script>";
                    }else{
                        echo $rs['error'];
                    }
                }
            }
        }
    ?>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

 
<?php include('include/footer.php') ?> 
