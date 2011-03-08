package uacp.showcase.client;

import java.util.Iterator;

import com.google.gwt.core.client.EntryPoint;
import com.google.gwt.event.logical.shared.SelectionEvent;
import com.google.gwt.event.logical.shared.SelectionHandler;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestBuilder;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.RootPanel;
import com.google.gwt.user.client.ui.Tree;
import com.google.gwt.user.client.ui.TreeItem;

/**
 * Entry point classes define <code>onModuleLoad()</code>.
 */
public class Uacp_showcase implements EntryPoint,ShowcaseCommon {
	
	Tree tree=new Tree();
	ShowExample se =new ShowExample();
	
	private void addToTree(String str){
		tree.addItem(str);	
	}
	public void onModuleLoad() {
		RootPanel.get("tabPanelContainer").add(ShowExample.thigsToShow);
		RootPanel.get("chooserContainer").add(tree);
		tree.setWidth("100%");
		tree.addSelectionHandler(new SelectionHandler<TreeItem>() {
				public void onSelection(SelectionEvent<TreeItem> event) {
					TreeItem item =event.getSelectedItem();
					se.add(item.getText());
				}
			});
	
		
		RequestBuilder rb = new RequestBuilder(RequestBuilder.GET, toolsBasePath+"listdir.php?dirs=1");
		rb.setTimeoutMillis(2000);
		rb.setCallback(new RequestCallback() {
		
		public void onResponseReceived(Request request, Response response) {
			JSONValue jsonValue=JSONParser.parse(response.getText());
			
			if(jsonValue.isObject() != null){
				JSONObject jso= jsonValue.isObject();
				Iterator<String>iter=jso.keySet().iterator();
				while(iter.hasNext()){
					addToTree(jso.get(iter.next()).isString().stringValue());
				}
				tree.setSelectedItem(tree.getItem(2));
			}
		}
		
		public void onError(Request request, Throwable exception) {		
		}
		

		});	
		
		try {
			rb.send();
		} catch (RequestException e) {
			e.printStackTrace();
		}

	}
	
	
}