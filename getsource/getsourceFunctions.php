<?php

function toGetSource(){
	chdir(sys_get_temp_dir());
	createFolder("getsource");
	chdir("getsource");
}

