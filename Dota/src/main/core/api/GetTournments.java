package main.core.api;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.bson.Document;

import com.mongodb.BasicDBObject;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.model.Projections;

import main.db.Connection;

public class GetTournments {
	
	
	
	public static void main(String[] args) {

		TournmentList();
		
	}
	
	public static ArrayList<String> TournmentList(){
		
		ArrayList<String> holder = new ArrayList<>();
		HashMap<String, String> da=new HashMap<>();
		MongoDatabase database = new Connection().getConnections();
		MongoCollection<Document> collection = database.getCollection("dotadump");
		FindIterable<Document>  myCursor =collection.find().projection(Projections.fields(Projections.include("leaguename"),Projections.excludeId()));
		//List<String> categories = collection.distinct("categories",dbObject, null);
		int i=0,j=0;
		for (Document document : myCursor) {
			i++;
			da.put(document.getString("leaguename"), "");
			
		}
		System.out.println(i);
		for (String document : da.keySet()) {
			holder.add(document);
			//System.out.println(document);
		}
		//System.out.println(j);
		//System.out.println("ratio"+i/j);
		return holder;
	}

}
