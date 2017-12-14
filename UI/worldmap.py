from mpl_toolkits.basemap import Basemap
import matplotlib.pyplot as plt

m = Basemap(projection='mill',
            llcrnrlat = -90,
            llcrnrlon = -180,
            urcrnrlat = 90,
            urcrnrlon = 180,
            resolution='l')

m.drawcoastlines()
m.drawcountries()
#m.drawstates()
##m.drawcounties(color='darkred')
#m.fillcontinents(color = 'green', lake_color = '#FFFFFF')
#m.etopo()
m.bluemarble()

cities = ['Atlanta','Austin','Boston','Chicago','Dallas','Houston','Los Angeles','Miami','New York City','San Antonio','San Francico','Washington D.C','Sao Paulo','Brasilia','Rio','Salvador','Lima','Istanbul','Moscow','London','Ankara','Berlin','Mardrid','Sydney','Brisbane','Melbourne','Cairo','Bangkok','Jakarta','Macau','Shangai','Shenzen','South Korea','Beijing','Taipei','Singapore']

lat = [33.7490,30.2672,42.3601, 41.8781,32.7766,29.7640,34.0522,25.7617,40.7306,29.4241,37.7749,38.9072,-24.0082,-23.082229,-22.9,-13.016015,-12.253289,40.811404,55.4899,51.38494,39.730421,52.338234,40.312064,-34.118347,-27.7674,-38.4339,30.008375,13.494088,-6.3708,22.1066,30.6756,22.4386,37.57461,39.4428,24.79008,1.1496]
lon = [-84.3880,-97.7431,-71.0589,-87.6298,-96.7969,-95.3698,-118.2437,-80.1918,-73.935242,-98.4936,-112.4194,-77.0369,-46.3651,-43.096904,-57.45,-38.306757,-76.78834,29.428805,37.9457,0.148271,33.007056,13.761117,-3.524912,151.343021,153.3179,145.5125,31.301973,100.938408,106.9728,113.6127,122.2471,114.6285,126.993371,117.5146,121.730082,104.0945]

x,y = m(lon,lat)

m.plot(x,y,'ro',markersize=4, alpha=.5)

#for printng the city name beside the red dot
for city, xc, yc in zip(cities,x,y):
   plt.text(xc+250000, yc-150000, city,
    bbox=dict(facecolor='yellow', alpha=0.5))

plt.title('Major Cities of DOTA2 Tournaments')
plt.show()
