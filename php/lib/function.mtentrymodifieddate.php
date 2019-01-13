<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtentrymodifieddate($args, &$ctx)
{
    $entry = $ctx->stash('entry');
    $args['ts'] = $entry->entry_modified_on;
    $args['ts'] or $args['ts'] = $entry->entry_created_on;
    return $ctx->_hdlr_date($args, $ctx);
}
