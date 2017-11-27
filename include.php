<?php

    /**
     * Simple include file for the library, so it can be used
     * easily with out composer.
     */

    // Include the contracts
    include 'source/Contract/Library.php';
    include 'source/Contract/Factory.php';
    include 'source/Contract/Instance.php';

    include 'source/Mixin/Library.php';

    // Include the source files
    include 'source/Library.php';
    include 'source/Factory.php';
    include 'source/Instance.php';

    // Include the exceptions
    include 'source/Exception.php';
    include 'source/Exception/ClassDoesNotExist.php';
    include 'source/Exception/ArgumentDoesNotExist.php';

