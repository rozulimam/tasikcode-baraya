<style type="text/css">
    #crop_area { width: 100%; height: 200px; display: none; margin-bottom: 50px; }
    #btn_get { display: none; }
    #avatar { width: 100%; height: auto; display: none}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=$title?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?=$title?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a class="btn btn-primary" href="<?=base_url('admin/users/add')?>">
                <i class="fa fa-user-plus"></i> Tambah pengguna
            </a>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">

                </div>
                <div class="ibox-content">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th width="1"><input type="checkbox" id="AllCheck"></th> 

                                <th width="1"></th>  
                                <th>Nama</th>
                                <th width="1">E-mail</th>  
                                <th width="100">Level</th>  
                                <th width="1">Akses</th>  
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div id="menu_popup" style='display: none'>
                                        <button type="button" class="btn btn-danger btn-xs" id="btnDelete">
                                                <i class="fa fa-trash"></i> Hapus yang di tandai
                                        </button>
                                    </div> 
                                </td>
                            </tr>
                        </tfoot>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>