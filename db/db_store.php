<?php

    include_once "db.php";


    function create_store(&$param) {

        $store_mail = $param['store_email'];
        $store_pw = $param['store_pw'];
        $store_check_pw = $param['store_check_pw'];
        $nickname = $param['nickname'];
        $store_nm = $param['store_nm'];
        
        $sql = "INSERT INTO t_store
        (store_email,store_pw,nickname,store_nm)
        value
        ('$store_mail','$store_pw','$nickname','$store_nm')
        ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $result;
        }
        
        function id_check(&$param)
        {
            $store_email = $param['store_email'];
        
            $sql = "SELECT store_email 
                    from t_store
                    where store_email = '$store_email' 
            ";
            $conn = get_conn();
            $row = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($row);
            mysqli_close($conn); 
            if(isset($result['store_email']))
            {
            return true;
            }
            return false;
        }
        
        function login_store(&$param){
        
            $store_email = $param['store_email'];
    
                $sql = 
                "   SELECT A.*, B.menu_photo
                    from t_store A
                    INNER JOIN t_menu B
                    ON A.store_num = B.store_num
                    where store_email = '$store_email'
            ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return $row;
        }
        
        function upd_store_photo(&$param) {
            $sql = "UPDATE t_store
                       SET store_photo = '{$param["store_photo"]}' 
                     WHERE store_email = '{$param["store_email"]}'";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            return $result;
         }

         // 영업요일 등록/수정
        function sales_day(&$param){
            $mon = $param['mon'];
            $tue = $param['tue'];
            $wed = $param['wed'];
            $thu = $param['thu'];
            $fri = $param['fri'];
            $sat = $param['sat'];
            $sun = $param['sun'];
            
            $sql = 
            "   UPDATE t_store
                SET sales_day = '$mon $tue $wed $thu $fri $sat $sun'
                WHERE store_email = 'test@naver.com'
        
            ";
            $conn = get_conn();
        
            $result = mysqli_query($conn, $sql);
            return $result;
            
        }

        function store_time_insert(&$param){
            $store_email = $param['store_email'];
            $sales_time = $param['sales_time'];
    
            $store_open_hour = $_POST['sales_open_hour'];           
            $store_open_minute = $_POST['sales_open_minute'];           
            $store_close_hour = $_POST['sales_close_hour'];           
            $store_close_minute = $_POST['sales_close_minute'];      
            if(!isset($sales_time))  {
                $sql = 
            "   INSERT INTO t_store
                (sales_time)
                VALUE
                ('$store_open_hour$store_open_minute,$store_close_hour$store_close_minute')
                where store_email = '$store_email'
            ";
            }
            else{
                $sql = 
            "   UPDATE t_store
                SET sales_time = '$store_open_hour$store_open_minute,$store_close_hour$store_close_minute'
                where store_email = '$store_email'
            ";
            }
            
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);   
            
            mysqli_close($conn);   
            return $result; 
        }
        function store_notice_insert(&$param){
            $store_notice = $_POST['store_notice'];
            $store_email = $param['store_email'];
            if(!isset($store_notice))  {
                $sql = 
            "   INSERT INTO t_store
                (store_notice)
                VALUE
                ('$store_notice')
                where store_email = '$store_email'
            ";
            }
            else{
                $sql = 
            "   UPDATE t_store
                SET store_notice = '$store_notice'
                where store_email = '$store_email'
            ";
            }
            
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);   
            
            mysqli_close($conn);   
            return $result; 
    }
    // 해당 가게 메뉴 선택
    function store_menu_select(&$param){
        $store_num = $param['store_num'];
    
                $sql = 
                "   SELECT *
                    from t_menu
                    where store_num = '$store_num'
            ";
            $conn = get_conn();
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            return $row;
    }

    // 가게 메뉴 등록
    function store_menu_input(&$param){
        $category = $param['menu_category'];
        $menu_nm = $param['menu_nm'];
        $menu_intro = $param['menu_intro'];
        $menu_photo = $param['menu_photo'];
        $sales_count = $param['sales_count'];
        $price = $param['price'];
        $sub_price = $param['sub_price'];        
        $store_num = $param['store_num'];


        $sql =
        "   INSERT INTO t_menu
            (store_num, menu_cate, menu_nm, price, subed_price, subed_count, menu_intro, menu_photo)
            VALUE
            ('$store_num','$category','$menu_nm','$price', '$sub_price', '$sales_count','$menu_intro','$menu_photo')
            

        ";

        
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);   
        
        mysqli_close($conn);   
        return $result; 
}