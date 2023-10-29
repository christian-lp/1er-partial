DIR_DB="/var/www/html/ev_cristianlugo/data"
DIR_SH="/var/www/html/ev_cristianlugo/shells/normalizators"
DIR_LOG="/var/www/html/ev_cristianlugo/data/logs"

cd "$DIR_LOG" || exit
rm -f *.log

cd "$DIR_DB" || exit
rm -f *.dat

cd "$DIR_SH" || exit

while read -r app || [[ -n "$app" ]]; do
  LOG_RUN="$DIR_LOG/$(basename "$app" .php).log"
  echo "Running script --> $app"
  date >> "$LOG_RUN"

  if [[ "${app##*.}" = "php" ]]; then
    php "$app" > "$LOG_RUN"
  elif [[ "${app##*.}" = "py" ]]; then
  python3 "$app" > "$LOG_RUN"
  else
    echo "Unsupported script: $app"
  fi

  echo "Finished the script --> $app"
done < list.run