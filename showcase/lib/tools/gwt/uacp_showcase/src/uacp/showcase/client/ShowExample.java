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
import com.google.gwt.user.client.ui.Widget;

public class ShowExample implements ShowcaseCommon{
	
	static DecoratedTabPanel thigsToShow= new DecoratedTabPanel();
	
	public ShowExample(){
		thigsToShow.setAnimationEnabled(true);
	}
	
	public void add(final String loc){
		
		clearThigsToShow();
		Frame fr  = new Frame();
		thigsToShow.add(fr, "example");
		fr.setUrl(exampleBasePath+loc+"/index.php");
		setWidgetsSizeOfThigsToShow();		
		thigsToShow.selectTab(0);

		
		RequestBuilder rb = new RequestBuilder(RequestBuilder.GET, 
											   toolsBasePath+
											   "listdir.php?files=1&path="+loc);
		rb.setCallback(new RequestCallback() {
				
				public void onResponseReceived(Request request, Response response) {
					JSONValue jsonValue=JSONParser.parse(response.getText());

					if(jsonValue.isObject() != null){
						JSONObject jso= jsonValue.isObject();
						Iterator<String>iter=jso.keySet().iterator();
						while(iter.hasNext()){
							addToPanel(loc,jso.get(iter.next()).isString().stringValue());
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
	
void addToPanel(String location,final String nameOfFile){
		
		RequestBuilder rb = new RequestBuilder(RequestBuilder.GET, toolsBasePath+"showfile.php?file="+location+"/"+nameOfFile);
		
		rb.setCallback(new RequestCallback(){

			public void onResponseReceived(Request request, Response response) {
				ScrollPanel simplePanel= new ScrollPanel();
				thigsToShow.add(simplePanel,nameOfFile);
				setWidgetsSizeOfThigsToShow();
				HTML html=new HTML(response.getText());
				simplePanel.add(html);
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