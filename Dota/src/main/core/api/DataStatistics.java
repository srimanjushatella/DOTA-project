package main.core.api;

import java.util.ArrayList;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;

import org.bson.Document;

import com.mongodb.BasicDBObject;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;

import main.db.Connection;


@Path("/data")
public class DataStatistics {
	
	@GET
	@Path("/list")
	@Produces("application/json")
	public String getStatistics(@QueryParam("collection") String coll) {
		StringBuilder sb=new StringBuilder();
		//System.out.println(coll);
		Connection connection = new Connection();
		MongoDatabase database = connection.getConnections();
		MongoCollection<Document> collection =database.getCollection(coll);
		//System.out.println(collection.getNamespace());
		if(!database.listCollectionNames().into(new ArrayList<String>()).contains(coll)) {
			
			return("Collection not found");
			
		}
		sb.append("Collection");
		sb.append(System.getProperty("line.separator"));
		sb.append(collection.getNamespace());
		sb.append(System.getProperty("line.separator"));
		sb.append(System.getProperty("line.separator"));
		sb.append(System.getProperty("line.separator"));
		sb.append("number of records");
		sb.append(System.getProperty("line.separator"));
		sb.append(collection.count());
		sb.append(System.getProperty("line.separator"));
		sb.append(System.getProperty("line.separator"));
		sb.append(System.getProperty("line.separator"));
		sb.append("Format of Data");
		sb.append(System.getProperty("line.separator"));
		sb.append(collection.find().first().toString());
		return sb.toString();
	}
	

}
