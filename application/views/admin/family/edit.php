<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal"> 
        <div class="form-group">
                <label class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" value="<?php echo $data->name ?>">
                </div> 
            </div>     
            <div class="form-group">
                <label class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" value="<?php echo $data->email ?>">
                </div> 
            </div>     
            <div class="form-group">
                <label class="col-sm-4 control-label">Pekerjaan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="title" value="<?php echo $data->title ?>">
                </div> 
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Keahlian</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="skill"><?php echo $data->skill ?></textarea> 
                </div> 
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Link Facebook</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="link_fb" value="<?php echo $data->link_fb ?>">
                </div> 
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Link Linkedin</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="link_in" value="<?php echo $data->link_in ?>">
                </div> 
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Link Github</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="link_git" value="<?php echo $data->link_git ?>">
                </div> 
            </div>   
            <div class="form-group">
                <label class="col-sm-4 control-label">Publish</label>
                <div class="col-sm-4">
                    <select class="form-control" id="publish">
                        <option value="1" <?php echo selected(1,$data->publish) ?>>Ya</option>
                        <option value="0" <?php echo selected(0,$data->publish) ?>>Tidak</option> 
                    </select> 
                </div> 
            </div> 
        </form>  
    </div> 
</div> 
<input type="hidden" value="<?php echo $data->id ?>" id="id"> 