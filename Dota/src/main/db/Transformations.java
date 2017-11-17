package main.db;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.bson.Document;

import com.mongodb.BasicDBList;
import com.mongodb.BasicDBObject;
import com.mongodb.DBCursor;
import com.mongodb.client.DistinctIterable;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;

public class Transformations {
	ArrayList<String> matches= new ArrayList<>();
	public void FilerRawData() {
		DateFormat dateFormat = new SimpleDateFormat("HH:mm:ss");
		System.out.println("starting ETL Process at time");
		System.out.println(dateFormat.format(new Date()));
		Connection connection = new Connection();
		BasicDBObject document = new BasicDBObject();

		MongoDatabase database = connection.getConnections();
		MongoCollection<Document> collection = database.getCollection("dotadump");
		MongoCollection<Document> newCollection = database.getCollection("records");
		DistinctIterable<Long> myCursor= collection.distinct("match_id", Long.class);
		int i=0;
		for (Long string : myCursor) {
			BasicDBObject whereQuery = new BasicDBObject();
			whereQuery.put("match_id", string);
			FindIterable<Document> cursor=collection.find(whereQuery);
			Document FinalRecord = new Document();
			FinalRecord.put("match_id",string);
			List<Object> win = new BasicDBList();
			List<Object> lost = new BasicDBList();
			for (Document records : cursor) {
				
			
				if(records.getBoolean("win").equals(true))
				{
					
					win.add(records.get("hero_id"));
				}
				else
				{
					BasicDBObject temp = new BasicDBObject();
					lost.add(records.get("hero_id"));
					
				}
			}
			FinalRecord.put("win", win);
			FinalRecord.put("lost", lost);
			//System.out.println("new created record");
			//System.out.println(FinalRecord.toJson());
			newCollection.insertOne(FinalRecord);
		
		}
		System.out.println("Ended ETL Process at time");
		System.out.println(dateFormat.format(new Date()));
	
	}


}
