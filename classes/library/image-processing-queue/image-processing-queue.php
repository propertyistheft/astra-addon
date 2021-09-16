<?php
/*
 * Copyright (c) 2020 Delicious Brains. All rights reserved.
 *
 * Released under the GPL license
 * https://www.opensource.org/licenses/gpl-license.php
 */

defined( 'WPINC' ) or die;

require_once ASTRA_EXT_DIR . 'classes/library/batch-processing/wp-async-request.php';
require_once ASTRA_EXT_DIR . 'classes/library/batch-processing/wp-background-process.php';
require_once ASTRA_EXT_DIR . 'classes/library/image-processing-queue/includes/class-ipq-process.php';
require_once ASTRA_EXT_DIR . 'classes/library/image-processing-queue/includes/class-image-processing-queue.php';
require_once ASTRA_EXT_DIR . 'classes/library/image-processing-queue/includes/ipq-template-functions.php';

Image_Processing_Queue::instance();
