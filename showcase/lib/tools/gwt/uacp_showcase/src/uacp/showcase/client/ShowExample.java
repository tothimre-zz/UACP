package uacp.showcase.client;

import java.util.Iterator;

import com.google.gwt.event.logical.shared.ResizeEvent;
import com.google.gwt.event.logical.shared.ResizeHandler;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestBuilder;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
import com.google.gwt.user.client.ui.DecoratedTabPanel;
import com.google.gwt.user.client.ui.Frame;
import com.google.gwt.user.client.ui.HTML;
import com.google.gwt.user.client.ui.ScrollPanel;
import com.google.gwt.user.client.ui.SimplePanel;
import com.google.gwt.user.client.ui.TreeItem;
import com.google.gwt.user.client.ui.Widget;

public class ShowExample implements ShowcaseCommon{
	
	static DecoratedTabPanel thigsToShow= new DecoratedTabPanel();
	String selectedLocation=null;
	
	public ShowExample(){
		thigsToShow.setAnimationEnabled(true);
	}
	
	public void add(final String location){
		
		if(this.selectedLocation==null
				||
			!location.equals(this.selectedLocation))
		{
			this.selectedLocation=location;
			clearThigsToShow();
			SimplePanel panel=new SimplePanel();
			Frame fr  = new Frame();
			panel.add(fr);
			thigsToShow.add(panel, "example");
			fr.setUrl(exampleBasePath+location+"/index.php");
			setWidgetsSizeOfThigsToShow();		
			fr.setSize("100%", "100%");
			thigsToShow.selectTab(0);

		
		RequestBuilder rb = new RequestBuilder(RequestBuilder.GET, 
											   toolsBasePath+
											   "listdir.php?files=1&path="+location);
		rb.setCallback(new RequestCallback() {
				
				public void onResponseReceived(Request request, Response response) {
					JSONValue jsonValue=JSONParser.parse(response.getText());

					if(jsonValue.isObject() != null){
						JSONObject jso= jsonValue.isObject();
						Iterator<String>iter=jso.keySet().iterator();
						while(iter.hasNext()){
							ScrollPanel panel=new ScrollPanel();
							thigsToShow.add(panel, "Downloading....");
							ajaxToPanel(panel,location,jso.get(iter.next()).isString().stringValue());
						}
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
		
		Window.addResizeHandler(new ResizeHandler() {	
			public void onResize(ResizeEvent event) {
				setWidgetsSizeOfThigsToShow();
				
			}
		});
				
	}
	
	public static DecoratedTabPanel getThigsToShow() {
		return thigsToShow;
	}

	private void setWidgetsSizeOfThigsToShow(){
		for (int i=0;i<thigsToShow.getWidgetCount();i++){
			Widget wd=thigsToShow.getWidget(i);
			wd.setWidth(Window.getClientWidth()-200+"px");
			wd.setHeight(Window.getClientHeight()-50+"px");
		}
	}
	private void clearThigsToShow(){		
		thigsToShow.clear();
	}
	
void ajaxToPanel(final ScrollPanel panel,String location,final String nameOfFile){
		
		RequestBuilder rb = new RequestBuilder(RequestBuilder.GET, toolsBasePath+"showfile.php?file="+location+"/"+nameOfFile);
		
		rb.setCallback(new RequestCallback(){

			public void onResponseReceived(Request request, Response response) {
				thigsToShow.add(panel,nameOfFile);
				HTML html=new HTML(response.getText());
				panel.add(html);
				
				setWidgetsSizeOfThigsToShow();
			}
			
			public void onError(Request request, Throwable exception) {
				
			}
		});
		try {
			rb.send();
		} catch (RequestException e) {
			e.printStackTrace();
		}
		this.setWidgetsSizeOfThigsToShow();
	}
}