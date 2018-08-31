var tag = document.createElement('script');



tag.src = "https://www.youtube.com/iframe_api";

var firstScriptTag = document.getElementsByTagName('script')[0];

firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

//biến cho video slider trang chủ site
var playersSlider = {};
var players = [];



function onYouTubeIframeAPIReady() {

    //video slider ở trang chủ

    $('.slide .carousel-inner iframe').each(function(event) {
        var iframeID = $(this).attr('id');
        playersSlider[iframeID] = new YT.Player(iframeID, {
            events: {
                'onReady': function() {},
                'onStateChange': function(event) {
                    if (event.data == YT.PlayerState.PLAYING) {
                        $(".slide").carousel('pause');

                    }
                    if (event.data == YT.PlayerState.PAUSED) {
                        $(".slide").carousel('cycle');
                    }
                }
            }
        });
    });

    //khi click next thì dừng video
    $(".carousel-control,.carousel-indicators li").click(function() {
        $.each(playersSlider, function(i) {
            playersSlider[i].pauseVideo();
        })
    });

}







$(document).ready(function() {

    //back-to-top

    $('.back-to-top').on('click', function(e) {

        $("html, body").animate({ scrollTop: $("#top").offset().top }, 500);

    });

    //show btn back-to-top

    $(window).scroll(function(event) {

        if ($(window).scrollTop() > $(window).height()) {

            $('.back-to-top').removeClass('hidden');

        } else {

            $('.back-to-top').addClass('hidden');

        }

    });



    //carousel

    $(".owl-carousel").owlCarousel({

        loop: false,

        margin: 5,

        mouseDrag: false,

        nav: true,

        video: true,

        dots: false,

        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],

        responsive: {

            0: {

                items: 2

            },

            768: {

                items: 5

            },

            1000: {

                items: 5

            }

        }

    });



    //chi tiet san pham

    $(".owl-carousel").owlCarousel({

        loop: false,

        margin: 5,

        mouseDrag: false,

        nav: true,

        video: true,

        dots: false,

        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],

        responsive: {

            0: {

                items: 2

            },

            768: {

                items: 5

            },

            1000: {

                items: 5

            }

        }

    });







    /**

     * Modal

     */

    // setTimeout(function() {

    //     $("#modal-id").modal()

    // }, 3000)

    // 



    /**

     * localStorage

     */

    function storeLocal(id, time) {

        var videos = [];

        var video = { id, time };

        if (localStorage.getItem('thegioisoVideo')) {

            videos = JSON.parse(localStorage.getItem('thegioisoVideo'));

            var index = isExitVideo(id, videos);

            if (index !== false) {

                if (videos[index].time < time) {

                    videos[index] = video;

                    localStorage.setItem('thegioisoVideo', JSON.stringify(videos));

                }

            } else {

                videos.push(video);

                localStorage.setItem('thegioisoVideo', JSON.stringify(videos));

            }

        } else {

            videos.push(video);

            localStorage.setItem('thegioisoVideo', JSON.stringify(videos));

        }

    };



    function clearLocal() {

        localStorage.removeItem('thegioisoVideo');

    }



    function isExitVideo(id, array) {

        for (var i = 0; i < array.length; i++) {

            if (array[i].id == id) {

                return i;

            }

        }

        return false;

    }



    $(window).on('beforeunload', function(e) {

        videos = localStorage.getItem('thegioisoVideo');

        if (videos) {

            $.ajax({

                // edit khi lên hosting

                url: 'http://thegioiso.net.vn/api/historyvideo',

                type: 'POST',

                data: { videos: videos },

                success: function(response) {

                    console.log(response);

                }

            });

            clearLocal();

        }

    });



    /*

     ** Get time video

     */

    $('.inner').hover(function() {

        //bat đau tinh thoi gian

        var time = 0;

        //tang thoi gian moi giay

        var timer = setInterval(function() {

            ++time;

        }, 1000);

        //lay id cua video

        var id = $(this).children('.video').attr('id');

        //neu co id

        // if (id) {

        //lay chieu dai trong cua hinh

        var height = $(this).children().innerHeight() - 5;

        var width = $(this).children().innerWidth() - 15;

        //chen video vao web

        $(this).children('.video').append(`

                <iframe width="${width}" height="${height}" src="https://www.youtube.com/embed/${id}?modestbranding=0&autoplay=1&controls=0&showinfo=0&wmode=transparent"

                frameborder="0" allowfullscreen auto></iframe>

                `);

        //khi dua chuot ra ngoai

        $(this).mouseleave(function() {

            storeLocal(id, time);

            time = 0;

            clearInterval(timer);

        });

        // }

    }, function() {

        //xoa video khi khong con hover

        $(this).children('.video').html('');

    });



    /**

     * ====================Search=====================

     */

    //khung search

    var formResult = $('.search');

    //phan ket qua hien thi

    var resultSearch = $('.search .result');

    //loading khi mang yeu

    var loadingSearch = $('.loading-search');

    //thong bao khi goi api bi loi

    var seachFail = $('.fail-result');

    //khong tim thay san pham phu hop

    var searchNoneProduct = $('.result-none-product');

    //khong tim thay tin tuc phu hop

    var searchNoneNews = $('.result-none-news');

    //Ket qua con lai cua san pham

    var searchProductRemain = $('.product-remain');

    //Ket qua con lai cua tin tuc

    var searchNewsRemain = $('.news-remain');

    //Danh sach ket qua cua san pham

    var resultProduct = $('.result-product .product-list');

    //Danh sach ket qua cua tin tuc

    var resultNews = $('.result-news .news-list');

    //Input search

    var inputSearch = $('input#search');

    //Xem thêm kết quả

    var seeMoreResult = $('.see-more-result');

    // clear data cu

    function clearContentSearch() {

        searchProductRemain.html('');

        searchNewsRemain.html('');

        searchNoneProduct.hide();

        searchNoneNews.hide();

        resultProduct.html('');

        resultNews.html('');

        seeMoreResult.hide();

    }

    //khi user go vao input#search

    inputSearch.keyup(function() {

        //tu khoa nguoi dung nhap

        var key = this.value;

        if (key.length > 1) {

            // //hien thi ket qua

            loadingSearch.show();

            formResult.show();

            $.ajax({

                url: 'http://thegioiso.net.vn/api/search',

                type: 'POST',

                data: { key: key },

            })

            .done(function(data) {

                loadingSearch.hide();

                resultSearch.show();



                clearContentSearch();



                data = JSON.parse(data);



                if (data.product.length > 0) {

                    $.each(data.product, function(i, item) {

                        resultProduct.append(`<div class="item row">

                            <a href="${item.url}">

                            <div class="col-xs-5">

                            <img src="${item.img_url}" alt="" class="img-responsive">

                            </div>

                            <div class="col-xs-7">

                            <h4 style="color: #444; font-weight: 700; text-transform: uppercase; font-size: 15px;">${item.name}</h4>

                            <p style="color: #d35400; font-weight: 700; text-transform: uppercase; font-size: 13px;">${item.price}</p>

                            </div>

                            </a>

                            </div>`);

                    });

                } else {

                    searchNoneProduct.show();

                }

                if (data.news.length > 0) {

                    $.each(data.news, function(i, item) {

                        resultNews.append(

                            `<div class="news-item">

                            <div class="row">

                            <a href="${item.url}">

                            <div class="col-xs-8">

                            <p class="news-title">${item.name}</p>

                            <p class="news-time text-right">${item.time}</p>

                            </div>

                            <div class="col-xs-4">

                            <img src="${item.img_url}" class="img-responsive" alt="">

                            </div>

                            </a>

                            </div>

                            </div>`

                        );

                    });

                } else {

                    searchNoneNews.show();

                }



                if (data.productRemain > 0) {

                    seeMoreResult.show();

                    searchProductRemain.append(`Còn ${data.productRemain} sản phẩm khác.`);

                }



                if (data.newsRemain > 0) {

                    seeMoreResult.show();

                    searchNewsRemain.append(`Còn ${data.newsRemain} tin tức khác.`);

                }

            })

            .fail(function() {

                seachFail.show();

            })

            .always(function() {});



        } else {

            //an ket qua

            formResult.hide();

        }

    });

    //close searchkhi click ra ngoai

    $(document).mouseup(function(e) {

        var container = $(".search");



        // if the target of the click isn't the container nor a descendant of the container

        if (!container.is(e.target) && container.has(e.target).length === 0) {

            container.hide();

        }

    });



    //chạy lần đầu sẽ load số lượng sản phẩm trong giỏ hàng

    loadQuantity();



    $('.buyProduct').click(function() {

        //url của nút mua

        var url = $(this).attr('value');



        //div cha của nút mua

        var buttonBuy = $(this);



        $.ajax({

            url: url,

            type: "GET",

            dataType: "json",

            success: function(result) {

                if (result) {

                    //cập nhật số lượng giỏ hàng mini

                    loadQuantity();



                    //nếu nút mua có class 'bought'

                    if (buttonBuy.hasClass("bought")) {

                        buttonBuy.text("Mua hàng");

                        buttonBuy.removeClass("bought");

                    } else {

                        //nếu không có class 'bought'

                        buttonBuy.text("Đã mua ").append("<i class='fa fa-check fa-1x' aria-hidden='true'></i>");

                        buttonBuy.addClass("bought");

                    }

                } else

                    alert("Có lỗi xảy ra! Vui lòng thử lại");

            }

        });

    });



    //load số lượng giỏ hàng

    function loadQuantity() {

        $.ajax({

            url: "http://thegioiso.net.vn/site/cart/ajax_quantity",

            type: "GET",

            dataType: "text",

            success: function(data) {

                $(".cart").find('span').html("  " + data);

            }

        });

    }



    //sap xếp trên dt ở danh muc san pham

    $('.btn-sort').click(function() {

        console.log(1);

        $('.criteria.row').slideToggle(400);

    });



    var videoProduct = $('.video-product');

    var widthVideoProduct = videoProduct.width();

    videoProduct.height((3 / 4) * widthVideoProduct);



    var btnMinus = $('.minus');

    var btnPlus = $('.plus');

    var inputAmount = $('.inputAmount');



    inputAmount.change(function() {

        var value = inputAmount.val();

        if (value > 100) {

            inputAmount.val(100);

        }

    })



    btnMinus.click(function() {

        var value = inputAmount.val();

        if (value > 1) {

            inputAmount.val(+value - 1);

        }

    })



    btnPlus.click(function() {

        var value = inputAmount.val();

        if (value < 100) {

            inputAmount.val(+value + 1);

        }

    })



});