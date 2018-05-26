<?php

class PropEnt extends Model {
    var $table= 'entreprises INNER JOIN propositions ON entreprises.e_code = propositions.e_code';
}

?>