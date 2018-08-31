$(document).ready(function () {

    //event thay doi parent category
    $('#parent_category_2').on('change', function () {

        $('#category')

            .find('option')



            .remove()



            .end();

        id = this.value;


        $.ajax({



                url: 'http://thegioiso.net.vn/api/danhmucsanpham/' + id



            })



            .done(function (data) {



                data = JSON.parse(data);



                data.unshift({
                    id: "0",
                    name: "Tất cả"
                });



                $.each(data, function (i, item) {


                    $('#category')



                        .append($('<option>', {



                            value: item.id,



                            text: item.name



                        }));



                });



            })



            .fail(function () {



                console.log("error");



            })



    });


    $('#parent_category').on('change', function () {

        $('#parent_category_2')



            .find('option')



            .remove()



            .end();



        id = this.value;



        loadCategory(id);



    })

    //mac dinh load danh muc 1 điện thoại
    var action = window.location.href.split('/').find(function(action) {
        return action == 'sua';
    });

    if(!action) {
        loadCategory(1);
    }

    //load danh muc theo id



    function loadCategory(id) {



        $.ajax({



                url: 'http://thegioiso.net.vn/api/danhmucsanpham/' + id



            })



            .done(function (data) {



                data = JSON.parse(data);



                data.unshift({
                    id: "0",
                    name: "Tất cả"
                });



                $.each(data, function (i, item) {


                    $('#parent_category_2')



                        .append($('<option>', {



                            value: item.id,



                            text: item.name



                        }));



                });



            })



            .fail(function () {



                console.log("error");



            })



    }



    //Chua gia tri thay doi

    var listEdit = [];

    //khi is_show show_in_index is_hight_light thay doio

    $('td input[type="checkbox"]').change(function () {

        var name = this.name;

        var value = this.checked;

        var newObj = {
            name,
            value
        };

        insertEditQueue(listEdit, newObj);

    })

    // khi danh muc thay doi

    $('td select').change(function () {

        var name = this.name;

        var value = this.value;

        var text = $("select[name=" + name + "] option:selected").text();

        var newObj = {
            name,
            value,
            text
        };

        insertEditQueue(listEdit, newObj);

    })

    // khi ten, gia, giam gia thay doi

    $('td input[type="text"]').change(function () {

        var name = this.name;

        var value = this.value;

        var newObj = {
            name,
            value
        };

        insertEditQueue(listEdit, newObj);

    })

    //the vao array

    function insertEditQueue(array, obj) {

        if (array.length > 0) {

            for (let index = 0, length = array.length; index < length; index++) {

                if (array[index].name == obj.name) {

                    array[index].value = obj.value;

                    return;

                }

            }

            array.push(obj);

            return;

        }

        array.push(obj);

    }

    //btn sua nhanh

    var btnEditMode = $('.btnEditMode');

    var btnSave = $('.btnSave');

    var btnCancel = $('.btnCancel');

    // cac input

    var editModeOn = $('.editModeOn');

    var editModeOff = $('.editModeOff');



    btnEditMode.click(function () {

        editModeOff.hide();

        editModeOn.show();

        $(this).hide();

        btnSave.show();

        btnCancel.show();

    });



    btnCancel.click(function () {

        editModeOff.show();

        editModeOn.hide();

        $(this).hide();

        btnSave.hide();

        btnEditMode.show();

    })



    btnSave.click(function () {

        if (listEdit.length > 0) {

            $.ajax({

                    url: 'http://thegioiso.net.vn/admin/sanpham/update',

                    type: 'POST',

                    data: {
                        list: listEdit
                    },

                })

                .done(function (data) {

                    listEdit.forEach(function (item) {

                        if (item.value === true || item.value === false) {

                            $("input[type='checkbox'][name=" + item.name + "]").prop("checked", item.value);

                        }



                        if (item.text) {

                            $("p[name=" + item.name + "]").html(item.text);

                        } else {

                            $("p[name=" + item.name + "], a[name=" + item.name + "]").html(item.value);

                        }



                    });

                    showMessage('Thành công');

                    listEdit = [];



                    editModeOff.show();

                    editModeOn.hide();

                    btnSave.hide();

                    btnCancel.hide();

                    btnEditMode.show();

                })

                .fail(function () {

                    showMessage('Thất bại');

                })

        } else {

            showMessage('Không có gì thay đổi');

            editModeOff.show();

            editModeOn.hide();

            btnSave.hide();

            btnCancel.hide();

            btnEditMode.show();

        }

    })



    //check xem co muốn xoa hay không

    $(".delete").click(function (event) {

        event.preventDefault();

        var cfm = confirm("Bạn thật sự muốn xóa.");

        var value = $(this).attr('href');

        if (cfm) {

            console.log(value);

            $(location).attr('href', value);

        }
    });



    //back to top

    $('.back-to-top').on('click', function (e) {

        $("html, body").animate({
            scrollTop: $("#top").offset().top
        }, 500);

    });



    var alertMessage = $('.alert-message');

    function showMessage(content) {

        alertMessage.html(content).show()

        setTimeout(function () {

            alertMessage.slideUp('slow');

        }, 2000);

    }
    //     checkDataChange.initDataChange();
    // var checkDataChange = {
    //     initDataChange: function () {
    //         $('body').on('change', '#sortindex', checkDataChange.eventChange);
    //     },
    //     eventChange: function () {
    //         _sortIndex = $(this);
    //         _idSortIndex = _sortIndex.attr('data-id');
    //         console.log(_idSortIndex);
    //     }
    // }
    
    $('body').on('change', '#sortindex', function() {
            _sortIndex = $(this);
            _idSortIndex = _sortIndex.attr('data-id');
            _valSortIndex = _sortIndex.val();
            _url = _sortIndex.attr('data-url');
            $.ajax({
                url: _url,
                type: 'POST',
                data: {idSortIndex: _idSortIndex, valSortIndex: _valSortIndex}
            })
            .done(function(responsive) {
                console.log("success");
                console.log(responsive);
            })
    });
    $('body').on('change', '#sortcate', function() {
            _sortCate = $(this);
            _idSortCate = _sortCate.attr('data-id');
            _valSortCate = _sortCate.val();
            _url = _sortCate.attr('data-url');
            $.ajax({
                url: _url,
                type: 'POST',
                data: {idSortCate: _idSortCate, valSortCate: _valSortCate}
            })
            .done(function(responsive) {
                console.log("success");
                console.log(responsive);
            })
    });



})

