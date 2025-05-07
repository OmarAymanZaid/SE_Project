<?php

class EvaluationQuestion
{
    private $ID;
    private $questionText;


    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getQuestionText()
    {
        return $this->questionText;
    }

    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;
    }
}

?>