package main.core.api;

import java.util.ArrayList;
import java.util.HashMap;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import org.bson.Document;
import org.bson.conversions.Bson;
import org.json.simple.JSONObject;
import com.mongodb.BasicDBObject;
import com.mongodb.DBObject;
import com.mongodb.QueryBuilder;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;

import main.db.Connection;

@Path("/stats")
public class Statictics {
	ArrayList<String> TournmentList = new ArrayList<>();
	static HashMap<String, HashMap<Integer, Integer>> data = new HashMap<>();
	static HashMap<String, HashMap<Integer, Integer>> countrydata = new HashMap<>();
	static JSONObject finalobj = new JSONObject();

	static MongoDatabase database = new Connection().getConnections();

	@GET
	@Path("/list")
	@Produces("application/json")
	public String getStatistics(@QueryParam("continent") final boolean country,
			@QueryParam("tournmentname") final boolean tournmentname, @QueryParam("all") final boolean all) {
		TournmentList = GetTournments.TournmentList();

		if (country && data.size() < 10) {
			MongoCollection<Document> collection = database.getCollection("tourncon");
			FindIterable<Document> myCursor = collection.find();
			for (Document document : myCursor) {

				System.out.println(document);
			}

		}

		if (tournmentname && data.size() < 10) {
			MongoCollection<Document> collection = database.getCollection("dotadump");
			QueryBuilder whereQuery = new QueryBuilder();
			DBObject match = new BasicDBObject();
			int i = 0;
			for (String string : TournmentList) {
				match.put("leaguename", string);
				FindIterable<Document> myCursor = collection.find((Bson) match);
				for (Document document : myCursor) {
					int hero = (int) document.get("hero_id");
					HashMap<Integer, Integer> temp = data.get(string);
					if (null != temp && temp.containsKey(hero)) {
						temp.put(hero, temp.get(hero) + 1);

					} else {
						// System.out.println(i++);
						if (null == temp)
							temp = new HashMap<>();
						temp.put(hero, 1);
					}
					data.put(string, temp);
				}

			}

			for (String leaguename : data.keySet()) {
				HashMap<Integer, Integer> temp = data.get(leaguename);

				JSONObject obj1 = new JSONObject();

				for (int hero : temp.keySet()) {

					obj1.put(String.valueOf(hero), String.valueOf(temp.get(hero)));
					// System.out.println("hero id" + hero + ":" + temp.get(hero));
				}
				finalobj.put(leaguename, obj1);

			}

			return finalobj.toString();

		}
		return finalobj.toString();

	}

	public static void main(String[] args) {
		Statictics obj = new Statictics();
		obj.getStatistics(false, true, false);
		MongoCollection<Document> collection = database.getCollection("tourncon");
		FindIterable<Document> myCursor = collection.find();
		for (Document document : myCursor) {
			HashMap<Integer, Integer> temp = data.get(document.get("Pro Gamer League"));
			System.out.println(document);
			if (countrydata.containsKey(document.get("Europe"))) {
				for (Integer hero : temp.keySet()) {
					HashMap<Integer, Integer> holder = new HashMap<>();
					System.out.println("adding " + countrydata.get(document.get("Europe")).get(hero));
					if (null == countrydata.get(document.get("Europe")).get(hero))
						holder.put(hero, temp.get(hero));
					else
						holder.put(hero, countrydata.get(document.get("Europe")).get(hero) + temp.get(hero));
					countrydata.put((String) document.get("Europe"), holder);
				}
			} else {
				System.out.println("adding league data directly" + document.get("Pro Gamer League"));
				countrydata.put((String) document.get("Europe"), data.get(document.get("Pro Gamer League")));
			}

		}
		System.out.println(new JSONObject(countrydata));
	}

}
