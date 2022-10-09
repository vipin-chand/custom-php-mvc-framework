<?php

namespace App\Controllers;

class InvoiceController
{

    public function create()
    {

        echo <<<END
        <form action='/invoice' method="post">
            <input type="text" name="amount"> <span>amount</span>
        </form>
        END;
    }


    public function store()
    {
        var_dump($_POST);
    }
}