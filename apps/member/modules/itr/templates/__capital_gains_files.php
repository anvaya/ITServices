<table>
    <tfoot>
        <tr style="display: none;">            
            <td>
                <button class="purple-btn" onclick="myViewModel.addCapitalItem(1); return false;">Add Row</button>
            </td>
        </tr>
    </tfoot>
    <tbody data-bind="foreach: files">
        <!-- ko template: {'if': error.length >0} -->	
        <tr class="error">
            <td data-bind="text: error">                
            </td>
        </tr>
        <!-- /ko -->
        <tr>
            <td>
                <a onclick="return false;" data-bind="visible: filename().length > 0, attr: {'href':filename}">File Uploaded</a>
                <span data-bind="visible: filename().length > 0">&nbsp;Change: </span>
                <input type="file" data-bind="attr: {name: 'itr_submission[itr_files][' + $index() +'][filename]' }" />
            </td>
        </tr>
    </tbody>
</table><br />

