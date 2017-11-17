package main.core.api;

import java.util.ArrayList;
import java.util.List;

import javax.management.Query;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;

import org.bson.Document;
import org.bson.conversions.Bson;

import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.QueryBuilder;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Projections;

import main.db.Connection;

@Path("/process")
public class GetSuggestions {

	
	@GET
	@Path("/list")
	@Produces("application/json")
	public String getStatistics(@QueryParam("opponent") final List<String> oppo,@QueryParam("my") final List<String> self) {
		QueryBuilder  whereQuery = new QueryBuilder ();
		QueryBuilder  whereQuery1 = new QueryBuilder ();
		DBObject removeIdProjection = new BasicDBObject();
		StringBuilder sb=new StringBuilder();
		ArrayList<Integer> holder =new ArrayList<>();
		ArrayList<Integer> holder1 =new ArrayList<>();
		removeIdProjection.put("_id", 0);
		removeIdProjection.put("match_id", 0);
		removeIdProjection.put("lost", 0);
		MongoDatabase database = new Connection().getConnections();
		MongoCollection<Document> collRecords = database.getCollection("records");
		MongoCollection<Document> collHeros = database.getCollection("heros");
		for (String string : self) {
			System.out.println("adding "+string);
			//whereQuery.put("win", string);
			DBObject query = new BasicDBObject();
			query.put("name",string);
			//System.out.println(;
			holder.add((Integer) collHeros.find((Bson) query).first().get("id"));
		}
		for (String string : oppo) {
			System.out.println("adding "+string);
			DBObject query = new BasicDBObject();
			query.put("name",string);
			//whereQuery.put("lost", string);
			holder1.add((Integer) collHeros.find((Bson) query).first().get("id"));
		}
		whereQuery.put("win").all(holder);
		whereQuery.put("lost").all(holder1);
		FindIterable<Document>  myCursor =collRecords.find((Bson) whereQuery.get()).projection((Bson) removeIdProjection);
		for (Document document : myCursor) {
			System.out.println("adding docs");
			System.out.println(document.toJson());
			sb.append(document.toJson());
			
		}
		//System.out.println(sb.toString());
		
		return sb.toString();
		
	}
	
	
	
}
