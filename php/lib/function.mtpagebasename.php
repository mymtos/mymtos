<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

require_once('function.mtentrybasename.php');
function smarty_function_mtpagebasename($args, &$ctx)
{
    return smarty_function_mtentrybasename($args, $ctx);
}
