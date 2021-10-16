<script type="text/javascript">
    var end = new Date('10/12/2021 0:00 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown_jam').innerHTML = hours;
        document.getElementById('countdown_menit').innerHTML = minutes;
        document.getElementById('countdown_detik').innerHTML = seconds;
    }

    timer = setInterval(showRemaining, 1000);
</script>

<script>
    function tambah_keranjang(id){
        show_loader();
        $.ajax({
            url: "<?=url('/')?>/tambah_keranjang/"+id,
            type:"get",
            success:function(data){
                
                setTimeout(hide_loader, 10);
                get_jumlah_keranjang();
                console.log(data);
            }
        })
    }

    $(document).ready(function() {
        $('#age-select-1').popover({
            content: "<ul class='foo'><li>18</li><li>19</li><li>20</li><li>21</li><li>22</li><li>23</li><li>24</li><li>25</li></ul>",
            html: true,
            trigger: "click",
            placement: "bottom"
        });
    });
</script>
<script type="text/javascript">
    $('.flash_sale').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });	
    $('.list_brand').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });	

    $(document).ready(function(){
        get_jumlah_keranjang();

    })

    
</script>