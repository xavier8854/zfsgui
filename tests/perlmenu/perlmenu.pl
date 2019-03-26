#!/usr/bin/perl -w

###########################################################################
# $Id: perlmenu.pl, v0.9 r1 26/03/2019 13:39:19 CET XH Exp $
#
# Copyright 2019 Xavier Humbert <xavier.humbert@ac-nancy-metz.fr>
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are
# met:
#
# * Redistributions of source code must retain the above copyright
#   notice, this list of conditions and the following disclaimer.
# * Redistributions in binary form must reproduce the above
#   copyright notice, this list of conditions and the following disclaimer
#   in the documentation and/or other materials provided with the
#   distribution.
# * Neither the name of the Academie de Nancy Metz nor the names of its
#   contributors may be used to endorse or promote products derived from
#   this software without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
# "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
# LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
# A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
# OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
# LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
# DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
# THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
# OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
#
#
###########################################################################

use strict;
# use Devel::NYTProf;
use Curses;

#####
## PROTOS
#####
sub printMenu();
sub dealWithCommand($);

#####
## CONSTANTS
#####
my @items = (
	"Item1",
	"Item2",
	"Item3",
);
my $itemSelect = 0;

#####
## VARIABLES
#####
my $rc=0;
#####
## MAIN
#####

initscr();
curs_set(0);
# Enable keypad functionality
keypad(1);

printMenu();
while (my $key = getch()) {
	last if $key eq "q";
	if( $key eq KEY_DOWN) {
		$itemSelect ++;
		$itemSelect = 2 if $itemSelect > 2;
	} elsif ($key eq KEY_UP) {
		$itemSelect --;
		$itemSelect = 0 if $itemSelect < 0;
	} elsif ($key eq "\n") {
		dealWithCommand ($items[$itemSelect])
	}
	printMenu();
}

endwin;
exit ($rc);

#######################################################################

#####
## FUNCTIONS
#####

sub printMenu() {
# 	print "\033[2J";    #clear the screen
# 	print "\033[0;0H"; #jump to 0,0
	move(0,0);
	clear();
	while (my ($index, $elem) = each @items) {
		if ($index == $itemSelect) {
			printw "(*) ";
		} else {
			printw "( ) ";
		}
		printw $items[$index] . "\n";
	}
	printw "(q) Quit\n";
	refresh();
}

sub dealWithCommand($) {
	my $item = shift;
	printw "Running command for itm $item...\n";
	refresh();
	sleep(5);
}







=pod


=cut
