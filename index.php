<?php

include_once('lib.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="">
<head>
    <title>可视化建模</title>
    <link rel="stylesheet" type="text/css" href="css/design.css"/>
    <link rel="stylesheet" type="text/css" href="css/tbl_list_overlay.css"/>

    <script type="application/x-javascript" src="js/jquery.min.js"></script>
    <script type="application/x-javascript" src="js/jquery-ui.js"></script>
    <script type="application/x-javascript" src="js/jquery.cookie.js"></script>

    <script type="application/x-javascript" src="js/underscore-min.js"></script>
    <script type="application/x-javascript" src="js/backbone-min.js"></script>
    <script src="js/backbone-localstorage.js"></script>
    <script type="application/x-javascript" src="js/jsplumb.js"></script>

    <script type="text/javascript" src="coffee/core.js"></script>
    <script type="text/javascript" src="coffee/core.panes.js"></script>
    <script type="text/javascript" src="coffee/design.js"></script>
    <script type="application/x-javascript" src="js/tbl-selection.js"></script>

    <!--<script type="text/javascript" src="coffee/demo.js"> </script>-->
    <script type="application/x-javascript">

        window.swapnil = {};
        $(function () {
            if (localStorage) localStorage.clear();
            $.cookie('schema', '');

            $('.btn-refresh').click(function () {
                $('.output > pre').html(QueryBuilder.GenerateSQL());
            });

            $('.bool.expr').draggable({
                helper: 'clone'
            });
            App.setAppVisibility();
            bindAddTableEvts();
        })
    </script>


</head>


<body>

<!--<div id="content">-->

<div id="right-pane" class="design-mode">

    <div id="tool-bar">

        <!-- 数据库选择-->
        <span style="float: left;">
				数据库 :
				<select name="schema">
					<option value=""> -- 选择数据库 -- </option>

					<?php

                    $query = "SHOW SCHEMAS";
                    $result = mysqli_query($dbc, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $DBName = $row["Database"]
                        ?>
                        <option value="<?php echo $DBName; ?>"><?php echo $DBName ?></option>
                    <?php } ?>
				</select>
        </span>

        <span id="btn-add-table" class="tool-bar-btn"> 确定 </span>

        <!--表选择-->
        <div id="table-selection">
            <div id="">
                表选择
            </div>
            <div id="table-list">

            </div>
            <div id="table-btns">
				<span class="butn ok">
					GO
				</span>
            </div>
        </div>


    </div>


    <div id="content">
        <!--建模画板-->
        <div id="design-pane" class="pane" title="">
            <!--Contextmenu -->

            <!--design pane-->
        </div>

        <div id=tab class="tabb">
            <ul>
                <li><a href="#div1">字段编辑</a></li>
                <li><a href="#div2">SQL预览</a></li>
                <li><a href="#div2">数据预览</a></li>
            </ul>

            <div id="div3">
                <!--                表格-->
            </div>

            <div id=div2>
                <!-- SQL预览-->
                <div class="pane output-mode" id="sql-out">
                    <div class="output">
                        <!-- SQL output -->
                        <pre id="sql-text-op">
<!--					Select a schema and then add tables/views.-->
				</pre>
                    </div>
                </div>
            </div>

            <!--            <div id=div1>-->
            <!--                SQL编辑-->
            <!--                <div class="editor">-->
            <!--                    <fieldset id="pane-select" class="pane inline-pane">-->
            <!--                        <legend> SELECTED FIELDS</legend>-->
            <!--                    </fieldset>-->
            <!---->
            <!--                    <div class="inline-pane">-->
            <!--                        <fieldset id="pane-join" class="pane">-->
            <!--                            <legend>JOIN</legend>-->
            <!--                        </fieldset>-->
            <!--                        <fieldset id="pane-order-by" class="pane">-->
            <!--                            <legend> ORDER BY</legend>-->
            <!--                        </fieldset>-->
            <!--                    </div>-->
            <!---->
            <!--                    <fieldset id="pane-where" class="pane inline-pane">-->
            <!--                        <legend> WHERE</legend>-->
            <!--                        <label for=""></label><textarea id="" cols="30" rows="5"></textarea>-->
            <!--                    </fieldset>-->
            <!--                </div>-->
            <!--            </div>-->

            <div id=div1>
                <!-- SQL编辑-->
                <div class="editor">
                    <fieldset id="pane-select" class="pane inline-pane">
                        <legend> SELECTED FIELDS</legend>
                    </fieldset>

                    <div class="inline-pane">
                        <!--                        <fieldset id="pane-join" class="pane">-->
                        <!--                            <legend>JOIN</legend>-->
                        <!--                        </fieldset>-->
                        <fieldset id="pane-order-by" class="pane">
                            <legend> ORDER BY</legend>
                        </fieldset>
                    </div>
                    <fieldset id="pane-join" class="pane">
                        <legend>WHERE</legend>
                    </fieldset>
                    <fieldset id="pane-where" class="pane inline-pane">
                        <legend>AND</legend>
                        <label for=""></label><textarea id="" cols="30" rows="5"></textarea>
                    </fieldset>
                </div>
            </div>
        </div>


        <!--        <div class="box">-->
        <!--            <ul>-->
        <!--                <li>-->
        <!--                    <input type="radio" name="check" id="active1" checked><label for="active1">第一页</label>-->
        <!--                    <div class="pane output-mode" id="sql-out">-->
        <!--                        <div class="output">-->
        <!--                            <pre id="sql-text-op">-->
        <!--					Select a schema and then add tables/views.-->
        <!--				</pre>-->
        <!--                        </div>-->
        <!--                    </div> </li>-->
        <!--                <li>-->
        <!--                    <input type="radio" name="check" id="active2"><label for="active2">第二页</label>-->
        <!--                    <div>-->
        <!--                        <div class="editor">-->
        <!--                            <fieldset id="pane-select" class="pane inline-pane">-->
        <!--                                <legend> SELECTED FIELDS</legend>-->
        <!--                            </fieldset>-->
        <!---->
        <!--                            <div class="inline-pane">-->
        <!--                                <fieldset id="pane-join" class="pane">-->
        <!--                                    <legend>JOIN</legend>-->
        <!--                                </fieldset>-->
        <!--                                <fieldset id="pane-order-by" class="pane">-->
        <!--                                    <legend> ORDER BY</legend>-->
        <!--                                </fieldset>-->
        <!--                            </div>-->
        <!---->
        <!--                            <fieldset id="pane-where" class="pane inline-pane">-->
        <!--                                <legend> WHERE</legend>-->
        <!--                                <textarea id="" cols="30" rows="5"></textarea>-->
        <!--                            </fieldset>-->
        <!--                        </div></li>-->
        <!--                <li>-->
        <!--                    <input type="radio" name="check" id="active3"><label for="active3">第三页</label>-->
        <!--                    <div>诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。诸恶莫作，众善奉行，远报儿女，近在己身，苍天有眼，报应循环，但行好事，莫问前程。</div>-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->

    </div>
</div>

<!--表结构预览-->
<script id="table-label-template" type="text/template">
    <div class="close " title="">
        X
    </div>
    <%= TableName %>

</script>

<!--1.  字段排序 -->
<!--2.  -->
<script id="table-field-template" type="text/template">

    <%
    strSign = '';
    strTitle = '';
    switch(Sort){
    case 'ASC':
    strSign = 'A';
    strTitle = 'Asc';
    break;
    case 'DESC':

    strSign = 'D';
    strTitle = 'Desc';
    break;
    default:

    strSign = '+';
    strTitle = '点击添加排序';
    }
    %>

    <div class="cell-dragger" title="<%= ColumnName %>">
        <div class="cell-edit">
 
      <span class=" <%= Sort=='UNSORTED' ? 'hoverable' : '' %> orderby " title=" <%= strTitle %> ">
			<%= strSign %>
      </span>

        </div>

        <input type="checkbox" name=""
        <%= Selected ? 'checked=checked':'' %> />
        <% var cellClass= (IsPrimaryKey) ? 'primary-key':'' %>
        <span class="field-name <%= cellClass %>" style="">
                        <%= ColumnName %>
                        <%= (Selected)? '': '' %>
                    </span>
    </div>

</script>

<script id="paneLi-select-template" type="text/template">
    <div class="<%= Selected ? 'line-item': 'hidden-item' %> ">


        <div class="icon delete"></div>
        <div class="property-editor">

            <div class="editable ">
								<span class="label">
								AS
								</span>
                <input type="text" class="alias" value="<%= Alias %>"/>
            </div>

            <div class="field-name">
                <%= TableName %>.<%= ColumnName %>
            </div>

        </div>
    </div>

</script>

<script id="paneLI-join-template" type="text/template">
    <div class="line-item">

        <div class="property-editor">
            <div class="field-name">
                <%= LeftTable %><%= (LeftField=='') ? '' : '.'+ LeftField %>
            </div>
            <div class="" style="padding-right:10px;">
                <%
                selInner = (Type == 'INNER') ? " selected='selected' " : "";
                selLeftOut = (Type == 'LEFT_OUTER') ? "selected='selected'" : "";

                selRightOut = (Type == "RIGHT_OUTER") ? "selected='selected'" : ""
                /*

                */
                %>
                <% if(Type =='CROSS_JOIN') { %>
                Cross Join
                <% }else{ %>
                <select name="">
                    <option
                    <%= selInner %> value=<%= 'INNER' %> > = </option>
                    <option
                    <%= selLeftOut %> value=<%= 'LEFT_OUTER' %> > > </option>
                    <option
                    <%= selRightOut %> value=<%= 'RIGHT_OUTER' %> > < </option>
                </select>

                <% } %>
            </div>
            <div class="field-name">
                <%= RightTable %><%= (RightField=='') ? '' : '.'+ RightField %>

            </div>
        </div>

    </div>

</script>

<script id="paneLI-orderby-template" type="text/template">
    <div class="<%= (Sort !== 'UNSORTED') ? 'line-item': 'hidden-item' %> ">

        <div class="icon delete"></div>
        <div class="property-editor">
            <div class="field-name">
                <%= TableName %>.<%= ColumnName %>
            </div>
            <div class="" style="padding-right:10px;float: right;">
                <select name="">
                    <% var selAsc = (Sort== 'ASC') ? "selected='selected'" : "" %>
                    <% var selDesc = (Sort== 'DESC') ? "selected='selected'" : "" %>
                    <option
                    <%= selAsc %> value="ASC" > Asc </option>
                    <option
                    <%= selDesc %> value="DESC" > Desc </option>
                </select>
            </div>

        </div>
    </div>

</script>

<!--<script id="sql-pane-template" type="text/template">
</script>-->

<script id="menu-item-template" type="text/template">
    <div class="menu-item">
        <a href="<%= link %>">
            <%= label %>
        </a>
    </div>
</script>

</body>
</html>
