<?php
  require_once "../connect.php";
  $paper_name = $min_pass_score = $mark_per_question = $paper_duration = $start_date = $end_date = $category ="";
  $start_date_err = $end_date_err = $chk_err = "";

      $paper_name = mysqli_real_escape_string($link, $_POST["paper_name"]);
      $min_pass_score = mysqli_real_escape_string($link, $_POST["min_pass_score"]);
      $mark_per_question = mysqli_real_escape_string($link, $_POST["mark_per_question"]);
      $paper_duration = mysqli_real_escape_string($link, $_POST["paper_duration"]);
      $start_date = mysqli_real_escape_string($link, $_POST["start_date"]);
      $end_date = mysqli_real_escape_string($link, $_POST["end_date"]);
      $paper_cat = mysqli_real_escape_string($link,$_POST["category"]);
      $questionIds =($_POST["questionIds"]);

      $chk = "";
      foreach ($questionIds as $questionIdsResult){
        $chk.=$questionIdsResult.",";
      }

      if($start_date == "0000-00-00" || empty(trim("$end_date"))){
         $start_date_err = "Başlangıç zamanı boş bırakılamaz.";
      }else if($start_date >= $end_date){
          $start_date_err = "Başlangıç zamanı bitiş zamanından büyük veya eşit olamaz.";
      }else{
         $start_date;
      }

      if(empty(trim("$end_date"))){
         $end_date_err = "Bitiş zamanı boş bırakılamaz.";
      }else{
         $end_date;
      }

      if(empty($start_date_err) && empty($chk_err)){
        $sql = "INSERT INTO papers (paper_name, min_pass_score, mark_per_question, paper_duration, start_date, end_date, category, questions) VALUES ('$paper_name', '$min_pass_score','$mark_per_question','$paper_duration','$start_date','$end_date','$paper_cat','$chk')";
        mysqli_query($link, $sql);

        header("location: ../papers.php");

        $link -> close();
    }

  ?>
