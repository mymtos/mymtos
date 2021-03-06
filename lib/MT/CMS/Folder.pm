# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$
package MT::CMS::Folder;

use strict;

sub edit {
    require MT::CMS::Category;
    return MT::CMS::Category::edit(@_);
}

sub can_view {
    my ( $eh, $app, $id, $objp ) = @_;
    my $author = $app->user;
    return 1 if $author->is_superuser();
    return unless $id;

    my $obj = $objp->force();
    return unless $obj;
    return if $obj->is_category;

    my $blog_id = $obj->blog_id;
    return $author->permissions($blog_id)->can_do('open_folder_edit_screen');
}

sub can_save {
    my ( $eh, $app, $obj ) = @_;
    my $author = $app->user;
    return 1 if $author->is_superuser();

    unless ( ref $obj ) {
        $obj = MT->model('folder')->load($obj)
            or return;
    }
    return unless $obj->isa('MT::Folder');

    my $blog_id = $obj->blog_id;
    return $author->permissions($blog_id)->can_do('save_folder');
}

sub can_delete {
    my ( $eh, $app, $obj ) = @_;
    my $author = $app->user;
    return 1 if $author->is_superuser();

    unless ( ref $obj ) {
        $obj = MT->model('folder')->load($obj)
            or return;
    }

    return unless $obj->isa('MT::Folder');

    my $blog_id = $obj->blog_id;
    return $author->permissions($blog_id)->can_do('delete_folder');
}

sub pre_save {
    my $eh = shift;
    my ( $app, $obj ) = @_;
    my $pkg      = $app->model('folder');
    my @siblings = $pkg->load(
        {   parent  => $obj->parent,
            blog_id => $obj->blog_id
        }
    );
    foreach (@siblings) {
        next if $obj->id && ( $_->id == $obj->id );
        return $eh->error(
            $app->translate(
                "The folder '[_1]' conflicts with another folder. Folders with the same parent must have unique basenames.",
                $_->label
            )
        ) if $_->basename eq $obj->basename;
    }
    1;
}

sub post_save {
    my $eh = shift;
    my ( $app, $obj, $original ) = @_;

    if ( !$original->id ) {
        $app->log(
            {   message => $app->translate(
                    "Folder '[_1]' created by '[_2]'", $obj->label,
                    $app->user->name
                ),
                level    => MT::Log::INFO(),
                class    => 'folder',
                category => 'new',
            }
        );
    }
    1;
}

sub save_filter {
    my $eh = shift;
    my ($app) = @_;
    return $app->errtrans( "The name '[_1]' is too long!",
        $app->param('label') )
        if ( length( $app->param('label') ) > 100 );
    return 1;
}

sub post_delete {
    my ( $eh, $app, $obj ) = @_;

    $app->log(
        {   message => $app->translate(
                "Folder '[_1]' (ID:[_2]) deleted by '[_3]'",
                $obj->label, $obj->id, $app->user->name
            ),
            level    => MT::Log::INFO(),
            class    => 'folder',
            category => 'delete'
        }
    );
}

1;
