<?php

    /**
     * Simple include file for the library, so it can be used
     * easily with out composer.
     */

    // Include the contracts
    include 'Source/Contract/Library.php';
    include 'Source/Contract/Object.php';
    include 'Source/Contract/Instance.php';

    include 'Source/Mixin/Library.php';

    // Include the source files
    include 'Source/Library.php';
    include 'Source/Instance.php';