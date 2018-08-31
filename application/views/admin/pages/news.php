<div class="col-sm-9 content product">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Tin tức</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-12" style="margin-top: 10px">
                <?php if ($message){
                    echo $message;                    
                } ?>
                <!-- form -->
                <div class="col-sm-9">
                    <form class="form-horizontal" action="" method="GET">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Từ khóa:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="key" name="keyword" placeholder="Nhập từ khóa cần tìm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sel1" class="control-label col-sm-4">Danh mục: </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="category">
                                    <option value="0" <?php if(!$idCategory || $idCategory == 0)echo "selected"?>>Tất cả</option>
                                    <?php foreach($listCategoryNews as $row)
                                    {
                                     ?>
                                    <option value="<?php echo $row->id;?>" <?php if($idCategory){if($idCategory == $row->id)echo "selected";}?> ><?=$row->name?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="button" class="btn btn-success btn-group-vertical searchNews">
                                    <b class="fa fa-search"></b> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end-form -->
                <!-- btn -->
                <div class="col-sm-3 text-right">
                    <a class="btn btn-info btn-lg" href="<?php echo admin_url('tintuc/them') ?>">
                        <b class="fa fa-plus-circle"></b> Thêm tin tức mới</a>
                </div>
                <!-- end-btn -->
                <!-- table -->
                <div class="col-sm-12">
                    <h3>Danh sách tin tức</h3>
                    <table class="table table-hover table-responsive text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>TÙY CHỌN</th>
                                <?php if($checkRole): ?>
                                <th>Xóa</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 0;
                                foreach($listNews as $row) :
                            ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        <?php echo $row->name ?>
                                    </td>
                                    <td>
                                        <?php echo get_date($row->create_at);
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo admin_url("tintuc/sua/").$row->id; ?>" class="btn btn-warning btn-xs">Thay đổi</a>
                                    </td>
                                    <?php if($checkRole): ?>
                                    <td>
                                        <a value="<?php echo admin_url("tintuc/xoa/").$row->id; ?>" class="btn btn-danger btn-xs delete">Xóa</a>
                                    </td>
                                <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row text-center">
                    <?php echo $pagination;?>
                    </div>
                </div>
                <!-- end-table -->
            </div>
        </div>
    </div>
</div>
<script>

 $(document).ready(function(){
    $("form input").keypress(function(e) {
        //Enter key
        if (e.which == 13) {
            e.preventDefault();
            var form =$("form");
        //problem: khi thay đổi option của input type="radio" thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)

        //lấy value của option vừa chọn
        var key = $('#key').val();
        var category = $('select option:selected').val();

        //trường hợp số trang nằm từ 1 đến 9999
        var patt = /([\d][?]|[\d][\d][?]|[\d][\d][\d][?]|[\d][\d][\d][\d][?])/g; 

        //lấy url hiện tại 
        var url = $(location).attr('href');

        //lấy được trang hiện tại kèm dấu ? ví dụ: 1?, 2?, 3?
        var page = url.match(patt);

        //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/(:num)?brand=all&price=0&order=0
        //nếu trang hiện tại có 1 trong các query string brand,price,order
        if(page)
        {
            //page hiện tại không phải là 1
            if (page != "1?") {

                //khi thay đổi option thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)
                url = url.replace(page, "1?");
               
                //cắt chuỗi
                var start = 0;
                var end = 0;
                for(var i = 0;i<url.length;i++)
                {
                    if(url[i]=='?')end = i;
                }
                //lấy url trước dấu ?
                url = url.substring(start, end);
                //nối chuỗi
                url = url.concat("?keyword="+key+"&category="+category);
                
                //redirect
                $(location).attr('href', url);
            }
            else //page hiện tại là 1 submit bình thường
                form.submit();
        }
        else
        {
            //có 3 trường hợp
            //trường hợp 1: url có dạng http://localhost:8080/thegioiso/admin/tintuc/(:num)
            //trường hợp 2: url có dạng http://localhost:8080/thegioiso/admin/tintuc/
            //trường hợp 3: url có dạng http://localhost:8080/thegioiso/admin/tintuc
            var arrayOption = url.split("/");
            
            //lấy trang hiện tại
            page = arrayOption[5];
            //nếu tồn tại trang hiện tại
            if(page)
            {
                var checkNumber = $.isNumeric(page);

                //kiểm tra trang hiện tại nếu là số thì là trường hợp 1
                if(checkNumber) {
                    //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc/(:num)
                    if (page != "1") {
                        //nếu trang hiện không phải 1 thì sẽ chuyển về trang 1 kèm theo option người dùng chọn
                        url = url.replace(page, "1");
                        //nối chuỗi
                        url = url.concat("?keyword="+key+"&category="+category);
                        //redirect
                        $(location).attr('href', url);
                    }
                    else//page hiện tại là 1 submit bình thường
                        form.submit();
                }
                
            }
            else
            {
                if (page == '') {
                    //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc/
                    url = url.concat("1");
                    //nối chuỗi
                    url = url.concat("?keyword="+key+"&category="+category);
                    //redirect
                    $(location).attr('href', url);
                }
                else
                //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc
            form.submit();
            }
        }
        }
    });
    $(".searchNews").click(function(){
        var form =$("form");
        //problem: khi thay đổi option của input type="radio" thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)

        //lấy value của option vừa chọn
        var key = $('#key').val();
        var category = $('select option:selected').val();

        //trường hợp số trang nằm từ 1 đến 9999
        var patt = /([\d][?]|[\d][\d][?]|[\d][\d][\d][?]|[\d][\d][\d][\d][?])/g; 

        //lấy url hiện tại 
        var url = $(location).attr('href');

        //lấy được trang hiện tại kèm dấu ? ví dụ: 1?, 2?, 3?
        var page = url.match(patt);

        //trường hợp url có dạng http://localhost:8080/thegioiso/danhmucsanpham/(:any)/(:num)?brand=all&price=0&order=0
        //nếu trang hiện tại có 1 trong các query string brand,price,order
        if(page)
        {
            //page hiện tại không phải là 1
            if (page != "1?") {

                //khi thay đổi option thì sẽ quay lại trang đầu chứ ko ở lại trang x (x thuộc 2 -> 9999)
                url = url.replace(page, "1?");
                //cắt chuỗi
                var start = 0;
                var end = 0;
                for(var i = 0;i<url.length;i++)
                {
                    if(url[i]=='?')end = i;
                }
                //lấy url trước dấu ?
                url = url.substring(start, end);
                //nối chuỗi
                url = url.concat("?keyword="+key+"&category="+category);
                //redirect
                $(location).attr('href', url);
            }
            else //page hiện tại là 1 submit bình thường
                form.submit();
        }
        else{
            //có 3 trường hợp
            //trường hợp 1: url có dạng http://localhost:8080/thegioiso/admin/tintuc/(:num)
            //trường hợp 2: url có dạng http://localhost:8080/thegioiso/admin/tintuc/
            //trường hợp 3: url có dạng http://localhost:8080/thegioiso/admin/tintuc
            var arrayOption = url.split("/");
            
            //lấy trang hiện tại
            page = arrayOption[5];
            //nếu tồn tại trang hiện tại
            if(page)
            {
                var checkNumber = $.isNumeric(page);

                //kiểm tra trang hiện tại nếu là số thì là trường hợp 1
                if(checkNumber) {
                    //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc/(:num)
                    if (page != "1") {
                        //nếu trang hiện không phải 1 thì sẽ chuyển về trang 1 kèm theo option người dùng chọn
                        url = url.replace(page, "1");
                        //nối chuỗi
                        url = url.concat("?keyword="+key+"&category="+category);
                        //redirect
                        $(location).attr('href', url);
                    }
                    else//page hiện tại là 1 submit bình thường
                        form.submit();
                }
                
            }
            else
            {
                if (page == '') {
                    //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc/
                    url = url.concat("1");
                    //nối chuỗi
                    url = url.concat("?keyword="+key+"&category="+category);
                    //redirect
                    $(location).attr('href', url);
                }
                else
                //trường hợp url có dạng http://localhost:8080/thegioiso/admin/tintuc
            form.submit();
            }
        }
    });
});

</script>