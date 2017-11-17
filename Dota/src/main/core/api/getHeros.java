package main.core.api;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;

import org.bson.Document;

import com.mongodb.BasicDBObject;
import com.mongodb.DBCursor;
import com.mongodb.client.DistinctIterable;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Field;
import com.mongodb.client.model.Projections;
import com.sun.research.ws.wadl.Include;

import main.db.Connection;
import main.db.Transformations;

@Path("/list")
public class getHeros {
	
	
	@GET
	@Path("/list")
	@Produces("application/json")
	public String heros() {
		
		//Transformations ts=new Transformations();
		//ts.FilerRawData();
		//BasicDBObject document = new BasicDBObject();
		StringBuilder sb=new StringBuilder();
		
		MongoDatabase database = new Connection().getConnections();
		MongoCollection<Document> collection = database.getCollection("heros");
		FindIterable<Document>  myCursor =collection.find().projection(Projections.fields(Projections.include("name","id"),Projections.excludeId()));
		for (Document document : myCursor) {
			
			sb.append(document.toJson());
			
		}
		
		
		return sb.toString();
	
	}

}

