<?php

class App_Question extends App_Models_Db_Wigi_Question {

  public function __construct($id=0) {


    if ($id > 0) {
      parent::__construct();

      $result = $this->fetchRow(
        $this->select()
          ->where('question_id = ?', $id)
      );


      $this->question_id                 = $result->question_id;
      $this->question                    = $result->question;
      $this->answer                      = $result->answer;
      $this->mobile_id                   = $result->mobile_id;
    }
  }

  public function getQuestion() {
    return $this->question;
  }

  public function getAnswer() {
    return $this->answer;
  }

  public function getMobileId() {
    return $this->mobile_id;
  }

  public function getPredefQuestions() {
    $result = array(
        "What is the city of your birth?",
        "What is the name of the high school from which you graduated?",
        "What is your spouse's middle name?",
        "What is your favorite sports team?",
        "What is your pet's name?",
        "What is your favorite artist's name?",
        "What is your favorite movie?",
        "Who was your childhood hero?",
        "Who is your all time favorite celebrity?",
        "What is the name of your high school mascot?",
        "What is your most memorable date?",
        "What is the name of your favorite aunt or uncle?",
    );

    shuffle($result);
    return $result;
  }

}

?>
