@extends('layout.main_layout')
@section('custom-style')

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .page-content{
            display: grid;
            height: 100%;
            width: 100%;
            margin-top: 50px;
            place-items: center;
            /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
        }
        ::selection{
            background: #4158d0;
            color: #fff;
        }
        .wrapper{
            width: 380px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        }
        .wrapper .title{
            font-size: 26px;
            font-weight: 600;
            text-align: center;
            line-height: 100px;
            color: #fff;
            user-select: none;
            border-radius: 15px 15px 0 0;
            background: linear-gradient(-135deg, #c850c0, #4158d0);
        }
        .wrapper form{
            padding: 10px 30px 50px 30px;
        }
        .wrapper form .field{
            height: 50px;
            width: 100%;
            margin-top: 20px;
            position: relative;
        }
        .wrapper form .field input{
            height: 100%;
            width: 100%;
            outline: none;
            font-size: 17px;
            padding-left: 20px;
            border: 1px solid lightgrey;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .wrapper form .field input:focus,
        form .field input:valid{
            border-color: #4158d0;
        }
        .wrapper form .field label{
            position: absolute;
            top: 50%;
            left: 20px;
            color: #999999;
            font-weight: 400;
            font-size: 17px;
            pointer-events: none;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }
        form .field input:focus ~ label,
        form .field input:valid ~ label{
            top: 0%;
            font-size: 16px;
            color: #4158d0;
            background: #fff;
            transform: translateY(-50%);
        }
        form .content{
            display: flex;
            width: 100%;
            height: 50px;
            font-size: 16px;
            align-items: center;
            justify-content: space-around;
        }
        form .content .checkbox{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form .content input{
            width: 15px;
            height: 15px;
            background: red;
        }
        form .content label{
            color: #262626;
            user-select: none;
            padding-left: 5px;
        }
        form .content .pass-link{
            color: "";
        }
        form .field input[type="submit"]{
            color: #fff;
            border: none;
            padding-left: 0;
            margin-top: -10px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
            background: linear-gradient(-135deg, #c850c0, #4158d0);
            transition: all 0.3s ease;
        }
        form .field input[type="submit"]:active{
            transform: scale(0.95);
        }
        form .signup-link{
            color: #262626;
            margin-top: 20px;
            text-align: center;
        }
        form .pass-link a,
        form .signup-link a{
            color: #4158d0;
            text-decoration: none;
        }
        form .pass-link a:hover,
        form .signup-link a:hover{
            text-decoration: underline;
        }
    </style>
@stop
@section('body')
    <div class="page-content">
        <div class="wrapper">
            <div class="title">
                Create blogs and news
            </div>
            <form action="{{route('blogs.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <input type="text" required name="name">
                    <label>Name</label>
                </div>
                <div class="field">
                    <input type="text" required name="description">
                    <label> Description</label>
                </div>

                <div class="field">
                    <div style="margin: 16px; padding: 16px">
                        <input
                            class="form-control form-control-lg"
                            type="file"
                            name="image"/>
                    </div>
                </div>
                <div class="field" style="margin-top: 40px">
                    <input type="submit" value="Create blogs and news">
                </div>
            </form>
        </div>
    </div>
@stop