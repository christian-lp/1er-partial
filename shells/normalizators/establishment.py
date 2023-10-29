import os

data = "../../data/toscovid.csv"
establishments = open('../../data/establishments.dat', 'a+')
cont = 1

with open(data, 'r') as archive:
    for line in archive:
        existe = 0
        data = line.split("|")
        est = data[5].strip()

        with open('../../data/establishments.dat', 'r') as archive2:
            for line2 in archive2:
                dato = line2.split("|")
                est2 = dato[1].strip()

                if est2 == est:
                    existe = 1

        if existe == 0:
            with open('../../data/establishments.dat', 'a+') as archive2:
                archive2.write(str(cont) + "|" + est + "\n")
                cont += 1
                
establishments.close()
archive.close()

print("Extraction completed successfully!\n")


"""
<br>
<br>
<button onclick="history.back()">Volver</button>
"""