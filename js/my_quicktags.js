//这儿共有四对引号，分别是按钮的ID、显示名、点一下输入内容、再点一下关闭内容（此为空则一次输入全部内容），\n表示换行。
QTags.addButton( 'hr', 'hr', "\n<hr />\n", '' );//添加横线
QTags.addButton( 'h2', 'h2', "\n<h2>", "</h2>\n" ); //添加标题2
QTags.addButton( 'h3', 'h3', "\n<h3>", "</h3>\n" ); //添加标题3
QTags.addButton( 'music', 'music', "\n[music]", "[/music]\n" );//添加音乐
QTags.addButton( 'reply', '回复可见', "\n[reply]", "[/reply]\n" );//回复可见
QTags.addButton( 'Down', '下载链接', "\n[Downlink href='下载链接']下载[/Downlink]\n", "" );//添加下载链接
