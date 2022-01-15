<?php

namespace allansm{
	class Test{
		static function hello(){
			print("helloworld");
		}
	}
}

namespace allansm\test{	
	class Test{
		function hello(){
			print("helloworld");
		}
	}

}

namespace allansm\test{
	class Test2{
		function w($txt){
			print("$txt\n");
		}
	}
}

namespace allansm{
	function hello(){
		print("helloworld");
	}
}

namespace allansm\a\b\c\d\e\f{
	function helloagain(){
		print("helloworld");
	}
}

namespace test{
	use allansm;

	$test = new allansm\Test();
	$test::hello();
}

namespace allansm{
	print("\n");
	
	Test::hello();
}

namespace{
	print("\n");

	$test = new allansm\test\Test();
	$test->hello();
}

namespace{
	use allansm\test\{Test,Test2};
	
	print("\n");

	$test = new Test();
	$test->hello();

	$test2 = new Test2();
	$test2->w("\nhello");
}

namespace{
	allansm\hello();
}

namespace{
	use allansm\a\b\c\d\e\f as abc;

	print("\n");
	abc\helloagain();
}

