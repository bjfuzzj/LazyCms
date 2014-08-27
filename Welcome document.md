##**目录**
###[<i class="icon-share"></i>模板标签说明](#gocmssql模板标签)
###[<i class="icon-share"></i>通用标签说明](#通用标签)
###[<i class="icon-share"></i>文章分类页标签说明](#文章分类页标签)
###[<i class="icon-share"></i>文章内容页标签说明](#文章内容页标签)
###[<i class="icon-share"></i>单页分类页标签说明](#单页分类页标签)
###[<i class="icon-share"></i>单页内容页标签说明](#单页内容页标签)

------------------------------------------


GoCMSSQL模板标签
---------------------------

本程序使用Smarty 3 模版引擎，模板中各标签都为Smarty 模板的自定义函数、块及变量。
标签开始：**<{%**
标签结束：**%}>**

**函数调用示例： <%{func param1=1, ..., paramN=N }%> **
块调用示例：
```

<%{block param1=1, ..., paramN=N }%>
<%{$row.id}%>
<%{$row.title}%>
<%{/block}%>

```
块公有属性为assign ，用于绑定返回值在块内容中记录属性提取，缺省值为row
块内容的记录属性的访问例如```<{$row.id}>, <{$row.title}>```
变量调用示例： ```<%{$param}%>```






----------------------


通用标签
---------------------------


```
<%{$title}%> 页面标题

<%{$path}%> 页面路径

<%{$keywords}%> 页面关键词

<%{$description}%>页面描述

<%{$row.url}%> 记录链接地址
```

**<%{site_config name='systitle'}%>**

* 函数作用：获取网站配置项值
* 标签属性：
* string name 必填，单一配置项名称
* name 可选项：sysname, sysurl, title, ceoemail, icp, icpurl, metakeyword,
metadescrip, makestatic, statictype, staticfolder, startyear

**<%{plate id='area_id' num=1}%>**

* 函数作用：获取页面板块内容
* 标签属性：
* string id 必填，板块标识
* int num 查询记录数目，仅图片类型有效，文本类限定为1 条


文章分类页标签
----------------
```
<%{$id}%> 当前分类 ID

<%{$cate}%> 当前分类相关信息数组

<%{$cate.name}%> 分类名称

<%{$cate.intro}%>分类简介

<%{$total}%> 当前分类总记录数

<%{$start}%> 当前分类列表起始记录 ID

<%{$start_param}%> 当前分类列表起始参数链接

<%{$page_url}%> 当前页面地址

<%{$page}%> 当前页分页信息数组

<%{$page.prev}%> 上一页

<%{$page.next}%> 下一页

<%{$year}%> 当前页面记录年份

```

**<%{func_article_category}%>**

* 函数作用：获取文章分类列表
* 标签属性：无

**<%{block_article_category assign='row'}%>**
**...**
**<%{/block_article_category}%>**

* 块作用：获取文章分类列表
* 标签属性：无
* 块内标签：
* cate_id, cate_name, cate_ab, intro, order_id, page_num, keywords, description



**<%{func_article_list cate_id=1 num=10 order_type=1 show_pic=0 show_intro=0}%>**

* 函数作用：获取文章不分页列表
* 标签属性：
* int cate_id 必填，文章分类ID
* int num 必填，查询的记录数，100 以内
* int order_type 建议填写，记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时
间降序，4-更新时间升序，5-点击数降序，6-点击数升序
* boolen show_pic 建议填写，是否显示默认图片
* boolen show_intro 建议填写，是否显示简介内容

**<%{block_article_list cate_id=1 num=10 order_type=1 assign='row'}%>**
**...**
**<%{/block_article_list}%>**

* 块作用：获取文章不分页记录列表
* 标签属性：
* int cate_id 必填，文章分类ID
* int num 必填，查询的记录数，100 以内
* int order_type 建议填写，记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时
间降序，4-更新时间升序，5-点击数降序，6-点击数升序
* 块内标签：
* article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic,
intro, update_time, hits

**<%{func_article_page_list cate_id=\$id  order_type=1 start=\$start page_num=\$cate.page_num}%>**

* 函数作用：获取文章分页列表
* 标签属性：
* int \$cate_id 文章分类ID
* int \$order_type 记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时间降序，
4-更新时间升序，5-点击数降序，6-点击数升序
* int \$start 从第几条记录开始
* int \$page_num 每页记录数目，建议设为\$cate.page_num，否则分页可能不正常


**<%{block_article_page_list cate_id=\$id order_type=1 start=\$start page_num=\$cate.page_num}%>**
**...**
**<%{/block_article_page_list}%>**

* 块作用：获取文章分页列表
* 标签属性：
* int \$cate_id 文章分类ID
* int \$order_type 记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
* int \$start 从第几条记录开始
* int \$page_num 每页记录数目，建议设为\$cate.page_num，否则分页可能不正常
* 块内标签：article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic,
intro, update_time, hits


**<%{func_article_page_year cate_id=$id year=$year order_type=1}%>**

* 函数作用：按年份获取文章记录不分页列表
* 标签属性：
* int \$cate_id 文章分类ID
* int \$year 年份
* int \$order_type 记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序

**<%{block_article_page_year cate_id=\$id year=\$year order_type=1}%>**
**...**
**<%{/block_article_page_year}%>**

* 函数作用：按年份获取文章记录不分页列表
* 标签属性：
* int \$cate_id 必填，文章分类ID
* int \$year 必填，查询的年份
* int \$order_type 记录排序类型：1-文章ID 降序，2-文章ID 升序，3-更新时间降序，4-更新时间升序，5-点击数降序，6-点击数升序
* 块内标签：
* article_id, cate_id, title, com_title, sub_title, copyfrom, tags, default_pic,intro, update_time, hits


**<%{year_list cate_id=\$id}%>**

* 函数作用：文章类按年份分页链接列表
* 标签属性：
* int cate_id 必填，分类ID

--------------------------------------------------------

文章内容页标签
-------------------------------
```
<%{$article.article_id}%> 文章 ID
<%{$article.cate_id}%> 归属分类 ID
<%{$article.title}%> 文章标题
<%{$article.author}%> 作者
<%{$article.copyfrom}%> 来源
<%{$article.tags}%> 文章标签
<%{$article.default_pic}%> 默认图片地址
<%{$article.intro}%> 文章简介
<%{$article.content}%> 文章正文内容
<%{$article.hits}%> 点击量
<%{$article.update_time}%> 内容更新时间
```

---------------------------------------

单页分类页标签
------------------------
```
<%{$id}%> 当前分类 ID
<%{$cate}%> 当前分类相关信息数组
<%{$cate.name}%> 分类名称
<%{$cate.intro}%>分类简介
```

**<%{func_page_category}%>**

* 函数作用：获取单页分类列表
* 标签属性：无

**<%{block_page_category assign='row'}%>**
**...**
**<%{/block_page_category}%>**

* 块作用：获取单页分类列表
* 标签属性：无
* 块内标签：cate_id, cate_name, cate_ab, intro, order_id

**<%{func_page_list cate_id=$id}%>**

* 函数作用：获取单页列表
* 标签属性：
* int cate_id 必填，单页分类ID

**<%{block_page_list cate_id=$id}%>**
**...**
**<%{/block_page_list}%>**

* 函数作用：获取单页记录内容列表
* 标签属性：
* int cate_id 必填，单页分类ID
* 块内标签：
* pageid, cate_id, title, path, default_pic, intro

-------------------------------------

单页内容页标签
--------------------------
```
<%{$page.page_id}%> 单页记录 ID
<%{$page.cate_id}%> 单页归属分类
<%{$page.title}%> 页面标题
<%{$page.default_pic}%> 默认图片地址
<%{$page.intro}%> 页面介绍
<%{$page.content}%> 页面内容
<%{$page.order_id}%> 同级排序号
<%{$page.update_time}%> 内容更新时间
```
