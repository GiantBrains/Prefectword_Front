<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $name
 * @property int $space_id
 * @property int $no_of_page
 * @property string $created_at
 *
 * @property Frontorder[] $frontorders
 * @property Order[] $orders
 * @property Spacing $space
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['space_id','no_of_page'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spacing::className(), 'targetAttribute' => ['space_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'no_of_page'=>'No. of pages',
            'space_id' => 'Space',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontorders()
    {
        return $this->hasMany(Frontorder::className(), ['pages_id' => 'id']);
    }

    public static function getThepages($spacing_id)
    {
        return self::find()->select(['name', 'id'])->where(['space_id'=> $spacing_id])->indexBy('id')->orderBy('id ASC')->column();
    }

    public static function getPages()
    {
        return self::find()->select(['name','id'])->indexBy('id')->orderBy('id ASC')->column();
    }

    public static function getSpacingList($spacing_id)
    {
        $subCategories = self::find()->select(['id','name'])
            ->where(['space_id'=> $spacing_id])
            ->asArray()
            ->all();

        return $subCategories;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpace()
    {
        return $this->hasOne(Spacing::className(), ['id' => 'space_id']);
    }

    /**
     * @inheritdoc
     * @return PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }

    public static function getOrderPages($pages_id)
    {
        switch ($pages_id) {
            case 1:
                $pages = 1;
            break;
            case $pages_id > 1 && $pages_id < 10:
                $pages = $pages_id * 0.95;
            break;
            case 10:
                $pages = 10 * 0.9;
            break;
            case 11:
                $pages = 11 * 0.9;
            break;
            case 12:
                $pages = 12 * 0.9;
            break;
            case 13:
                $pages = 13 * 0.9;
            break;
            case 14:
                $pages = 14 * 0.9;
            break;
            case 15:
                $pages = 15 * 0.9;
            break;
            case 16:
                $pages = 16 * 0.9;
            break;
            case 17:
                $pages = 17 * 0.9;
            break;
            case 18:
                $pages = 18 * 0.9;
            break;
            case 19:
                $pages = 19 * 0.9;
            break;
            case 20:
                $pages = 20 * 0.9;
            break;
            case 21:
                $pages = 21 * 0.85;
            break;
            case 22:
                $pages = 22 * 0.85;
            break;
            case 23:
                $pages = 23 * 0.85;
            break;
            case 24:
                $pages = 24 * 0.85;
            break;
            case 25:
                $pages = 25 * 0.85;
            break;
            case 26:
                $pages = 26 * 0.85;
            break;
            case 27:
                $pages = 27 * 0.85;
            break;
            case 28:
                $pages = 28 * 0.85;
            break;
            case 29:
                $pages = 29 * 0.85;
            break;
            case 30:
                $pages = 30 * 0.85;
            break;
            case 31:
                $pages = 31 * 0.85;
            break;
            case 32:
                $pages = 32 * 0.85;
            break;
            case 33:
                $pages = 33 * 0.85;
            break;
            case 34:
                $pages = 34 * 0.85;
            break;
            case 35:
                $pages = 35 * 0.85;
            break;
            case 36:
                $pages = 36 * 0.85;
            break;
            case 37:
                $pages = 37 * 0.85;
            break;
            case 38:
                $pages = 38 * 0.85;
            break;
            case 39:
                $pages = 39 * 0.85;
            break;
            case 40:
                $pages = 40 * 0.85;
            break;
            case 41:
                $pages = 41 * 0.85;
            break;
            case 42:
                $pages = 42 * 0.85;
            break;
            case 43:
                $pages = 43 * 0.85;
            break;
            case 44:
                $pages = 44 * 0.85;
            break;
            case 45:
                $pages = 45 * 0.85;
            break;
            case 46:
                $pages = 46 * 0.85;
            break;
            case 47:
                $pages = 47 * 0.85;
            break;
            case 48:
                $pages = 48 * 0.85;
            break;
            case 49:
                $pages = 49 * 0.85;
            break;
            case 50:
                $pages = 50 * 0.85;
            break;
            case 51:
                $pages = 51 * 0.85;
            break;
            case 52:
                $pages = 52 * 0.85;
            break;
            case 53:
                $pages = 53 * 0.85;
            break;
            case 54:
                $pages = 54 * 0.85;
            break;
            case 55:
                $pages = 55 * 0.85;
            break;
            case 56:
                $pages = 56 * 0.85;
            break;
            case 57:
                $pages = 57 * 0.85;
            break;
            case 58:
                $pages = 58 * 0.85;
            break;
            case 59:
                $pages = 59 * 0.85;
            break;
            case 60:
                $pages = 60 * 0.85;
            break;
            case 61:
                $pages = 61 * 0.85;
            break;
            case 62:
                $pages = 62 * 0.85;
            break;
            case 63:
                $pages = 63 * 0.85;
            break;
            case 64:
                $pages = 64 * 0.85;
            break;
            case 65:
                $pages = 65 * 0.85;
            break;
            case 66:
                $pages = 66 * 0.85;
            break;
            case 67:
                $pages = 67 * 0.85;
            break;
            case 68:
                $pages = 68 * 0.85;
            break;
            case 69:
                $pages = 69 * 0.85;
            break;
            case 70:
                $pages = 70 * 0.85;
            break;
            case 71:
                $pages = 71 * 0.85;
            break;
            case 72:
                $pages = 72 * 0.85;
            break;
            case 73:
                $pages = 73 * 0.85;
            break;
            case 74:
                $pages = 74 * 0.85;
            break;
            case 75:
                $pages = 75 * 0.85;
            break;
            case 76:
                $pages = 76 * 0.85;
            break;
            case 77:
                $pages = 77 * 0.85;
            break;
            case 78:
                $pages = 78 * 0.85;
            break;
            case 79:
                $pages = 79 * 0.85;
            break;
            case 80:
                $pages = 80 * 0.85;
            break;
            case 81:
                $pages = 81 * 0.85;
            break;
            case 82:
                $pages = 82 * 0.85;
            break;
            case 83:
                $pages = 83 * 0.85;
            break;
            case 84:
                $pages = 84 * 0.85;
            break;
            case 85:
                $pages = 85 * 0.85;
            break;
            case 86:
                $pages = 86 * 0.85;
            break;
            case 87:
                $pages = 87 * 0.85;
            break;
            case 88:
                $pages = 88 * 0.85;
            break;
            case 89:
                $pages = 89; // was this a mistake?
            break;
            case 90:
                $pages = 90 * 0.85;
            break;
            case 91:
                $pages = 91 * 0.85;
            break;
            case 92:
                $pages = 92 * 0.85;
            break;
            case 93:
                $pages = 93 * 0.85;
            break;
            case 94:
                $pages = 94 * 0.85;
            break;
            case 95:
                $pages = 95 * 0.85;
            break;
            case 96:
                $pages = 96 * 0.85;
            break;
            case 97:
                $pages = 97 * 0.85;
            break;
            case 98:
                $pages = 98 * 0.85;
            break;
            case 99:
                $pages = 99 * 0.85;
            break;
            case 100:
                $pages = 100 * 0.85;
            break;
            case 101:
                $pages = 101 * 0.85;
            break;
            case 102:
                $pages = 102 * 0.85;
            break;
            case 103:
                $pages = 103 * 0.85;
            break;
            case 104:
                $pages = 104 * 0.85;
            break;
            case 105:
                $pages = 105 * 0.85;
            break;
            case 106:
                $pages = 106 * 0.85;
            break;
            case 107:
                $pages = 107 * 0.85;
            break;
            case 108:
                $pages = 108 * 0.85;
            break;
            case 109:
                $pages = 109 * 0.85;
            break;
            case 110:
                $pages = 110 * 0.85;
            break;
            case 111:
                $pages = 111 * 0.85;
            break;
            case 112:
                $pages = 112 * 0.85;
            break;
            case 113:
                $pages = 113 * 0.85;
            break;
            case 114:
                $pages = 114 * 0.85;
            break;
            case 115:
                $pages = 115 * 0.85;
            break;
            case 116:
                $pages = 116 * 0.85;
            break;
            case 117:
                $pages = 117 * 0.85;
            break;
            case 118:
                $pages = 118 * 0.85;
            break;
            case 119:
                $pages = 119 * 0.85;
            break;
            case 120:
                $pages = 120 * 0.85;
            break;
            case 121:
                $pages = 121 * 0.85;
            break;
            case 122:
                $pages = 122 * 0.85;
            break;
            case 123:
                $pages = 123 * 0.85;
            break;
            case 124:
                $pages = 124 * 0.85;
            break;
            case 125:
                $pages = 125 * 0.85;
            break;
            case 126:
                $pages = 126 * 0.85;
            break;
            case 127:
                $pages = 127 * 0.85;
            break;
            case 128:
                $pages = 128 * 0.85;
            break;
            case 129:
                $pages = 129 * 0.85;
            break;
            case 130:
                $pages = 130 * 0.85;
            break;
            case 131:
                $pages = 131 * 0.85;
            break;
            case 132:
                $pages = 132 * 0.85;
            break;
            case 133:
                $pages = 133 * 0.85;
            break;
            case 134:
                $pages = 134 * 0.85;
            break;
            case 135:
                $pages = 135 * 0.85;
            break;
            case 136:
                $pages = 136 * 0.85;
            break;
            case 137:
                $pages = 137 * 0.85;
            break;
            case 138:
                $pages = 138 * 0.85;
            break;
            case 139:
                $pages = 139 * 0.85;
            break;
            case 140:
                $pages = 140 * 0.85;
            break;
            case 141:
                $pages = 141 * 0.85;
            break;
            case 142:
                $pages = 142 * 0.85;
            break;
            case 143:
                $pages = 143 * 0.85;
            break;
            case 144:
                $pages = 144 * 0.85;
            break;
            case 145:
                $pages = 145 * 0.85;
            break;
            case 146:
                $pages = 146 * 0.85;
            break;
            case 147:
                $pages = 147 * 0.85;
            break;
            case 148:
                $pages = 148 * 0.85;
            break;
            case 149:
                $pages = 149 * 0.85;
            break;
            case 150:
                $pages = 150 * 0.85;
            break;
            case 151:
                $pages = 151 * 0.85;
            break;
            case 152:
                $pages = 152 * 0.85;
            break;
            case 153:
                $pages = 153 * 0.85;
            break;
            case 154:
                $pages = 154 * 0.85;
            break;
            case 155:
                $pages = 155 * 0.85;
            break;
            case 156:
                $pages = 156 * 0.85;
            break;
            case 157:
                $pages = 157 * 0.85;
            break;
            case 158:
                $pages = 158 * 0.85;
            break;
            case 159:
                $pages = 159 * 0.85;
            break;
            case 160:
                $pages = 160 * 0.85;
            break;
            case 161:
                $pages = 161 * 0.85;
            break;
            case 162:
                $pages = 162 * 0.85;
            break;
            case 163:
                $pages = 163 * 0.85;
            break;
            case 164:
                $pages = 164 * 0.85;
            break;
            case 165:
                $pages = 165 * 0.85;
            break;
            case 166:
                $pages = 166 * 0.85;
            break;
            case 167:
                $pages = 167 * 0.85;
            break;
            case 168:
                $pages = 168 * 0.85;
            break;
            case 169:
                $pages = 169 * 0.85;
            break;
            case 170:
                $pages = 170 * 0.85;
            break;
            case 171:
                $pages = 171 * 0.85;
            break;
            case 172:
                $pages = 172 * 0.85;
            break;
            case 173:
                $pages = 173 * 0.85;
            break;
            case 174:
                $pages = 174 * 0.85;
            break;
            case 175:
                $pages = 175 * 0.85;
            break;
            case 176:
                $pages = 176 * 0.85;
            break;
            case 177:
                $pages = 177 * 0.85;
            break;
            case 178:
                $pages = 178 * 0.85;
            break;
            case 179:
                $pages = 179 * 0.85;
            break;
            case 180:
                $pages = 180 * 0.85;
            break;
            case 181:
                $pages = 181 * 0.85;
            break;
            case 182:
                $pages = 182 * 0.85;
            break;
            case 183:
                $pages = 183 * 0.85;
            break;
            case 184:
                $pages = 184 * 0.85;
            break;
            case 185:
                $pages = 185 * 0.85;
            break;
            case 186:
                $pages = 186 * 0.85;
            break;
            case 187:
                $pages = 187 * 0.85;
            break;
            case 188:
                $pages = 188 * 0.85;
            break;
            case 189:
                $pages = 189 * 0.85;
            break;
            case 190:
                $pages = 190 * 0.85;
            break;
            case 191:
                $pages = 191 * 0.85;
            break;
            case 192:
                $pages = 192 * 0.85;
            break;
            case 193:
                $pages = 193 * 0.85;
            break;
            case 194:
                $pages = 194 * 0.85;
            break;
            case 195:
                $pages = 195 * 0.85;
            break;
            case 196:
                $pages = 196 * 0.85;
            break;
            case 197:
                $pages = 197 * 0.85;
            break;
            case 198:
                $pages = 198 * 0.85;
            break;
            case 199:
                $pages = 199 * 0.85;
            break;
            case 200:
                $pages = 200 * 0.85;
            break;

            //single spaced
            case 201:
                $pages = 1;
            break;
            case 202:
                $pages = 2 * 0.95;
            break;
            case 203:
                $pages = 3 * 0.95;
            break;
            case 204:
                $pages = 4 * 0.95;
            break;
            case 205:
                $pages = 5 * 0.95;
            break;
            case 206:
                $pages = 6 * 0.925;
            break;
            case 207:
                $pages = 7 * 0.925;
            break;
            case 208:
                $pages = 8 * 0.925;
            break;
            case 209:
                $pages = 9 * 0.925;
            break;
            case 210:
                $pages = 10 * 0.9;
            break;
            case 211:
                $pages = 11 * 0.9;
            break;
            case 212:
                $pages = 12 * 0.9;
            break;
            case 213:
                $pages = 13 * 0.9;
            break;
            case 214:
                $pages = 14 * 0.9;
            break;
            case 215:
                $pages = 15 * 0.9;
            break;
            case 216:
                $pages = 16 * 0.9;
            break;
            case 217:
                $pages = 17 * 0.9;
            break;
            case 218:
                $pages = 18 * 0.9;
            break;
            case 219:
                $pages = 19 * 0.9;
            break;
            case 220:
                $pages = 20 * 0.9;
            break;
            case 221:
                $pages = 21 * 0.85;
            break;
            case 222:
                $pages = 22 * 0.85;
            break;
            case 223:
                $pages = 23 * 0.85;
            break;
            case 224:
                $pages = 24 * 0.85;
            break;
            case 225:
                $pages = 25 * 0.85;
            break;
            case 226:
                $pages = 26 * 0.85;
            break;
            case 227:
                $pages = 27 * 0.85;
            break;
            case 228:
                $pages = 28 * 0.85;
            break;
            case 229:
                $pages = 29 * 0.85;
            break;
            case 230:
                $pages = 30 * 0.85;
            break;
            case 231:
                $pages = 31 * 0.85;
            break;
            case 232:
                $pages = 32 * 0.85;
            break;
            case 233:
                $pages = 33 * 0.85;
            break;
            case 234:
                $pages = 34 * 0.85;
            break;
            case 235:
                $pages = 35 * 0.85;
            break;
            case 236:
                $pages = 36 * 0.85;
            break;
            case 237:
                $pages = 37 * 0.85;
            break;
            case 238:
                $pages = 38 * 0.85;
            break;
            case 239:
                $pages = 39 * 0.85;
            break;
            case 240:
                $pages = 40 * 0.85;
            break;
            case 241:
                $pages = 41 * 0.85;
            break;
            case 242:
                $pages = 42 * 0.85;
            break;
            case 243:
                $pages = 43 * 0.85;
            break;
            case 244:
                $pages = 44 * 0.85;
            break;
            case 245:
                $pages = 45 * 0.85;
            break;
            case 246:
                $pages = 46 * 0.85;
            break;
            case 247:
                $pages = 47 * 0.85;
            break;
            case 248:
                $pages = 48 * 0.85;
            break;
            case 249:
                $pages = 49 * 0.85;
            break;
            case 250:
                $pages = 50 * 0.85;
            break;
            case 251:
                $pages = 51 * 0.85;
            break;
            case 252:
                $pages = 52 * 0.85;
            break;
            case 253:
                $pages = 53 * 0.85;
            break;
            case 254:
                $pages = 54 * 0.85;
            break;
            case 255:
                $pages = 55 * 0.85;
            break;
            case 256:
                $pages = 56 * 0.85;
            break;
            case 257:
                $pages = 57 * 0.85;
            break;
            case 258:
                $pages = 58 * 0.85;
            break;
            case 259:
                $pages = 59 * 0.85;
            break;
            case 260:
                $pages = 60 * 0.85;
            break;
            case 261:
                $pages = 61 * 0.85;
            break;
            case 262:
                $pages = 62 * 0.85;
            break;
            case 263:
                $pages = 63 * 0.85;
            break;
            case 264:
                $pages = 64 * 0.85;
            break;
            case 265:
                $pages = 65 * 0.85;
            break;
            case 266:
                $pages = 66 * 0.85;
            break;
            case 267:
                $pages = 67 * 0.85;
            break;
            case 268:
                $pages = 68 * 0.85;
            break;
            case 269:
                $pages = 69 * 0.85;
            break;
            case 270:
                $pages = 70 * 0.85;
            break;
            case 271:
                $pages = 71 * 0.85;
            break;
            case 272:
                $pages = 72 * 0.85;
            break;
            case 273:
                $pages = 73 * 0.85;
            break;
            case 274:
                $pages = 74 * 0.85;
            break;
            case 275:
                $pages = 75 * 0.85;
            break;
            case 276:
                $pages = 76 * 0.85;
            break;
            case 277:
                $pages = 77 * 0.85;
            break;
            case 278:
                $pages = 78 * 0.85;
            break;
            case 279:
                $pages = 79 * 0.85;
            break;
            case 280:
                $pages = 80 * 0.85;
            break;
            case 281:
                $pages = 81 * 0.85;
            break;
            case 282:
                $pages = 82 * 0.85;
            break;
            case 283:
                $pages = 83 * 0.85;
            break;
            case 284:
                $pages = 84 * 0.85;
            break;
            case 285:
                $pages = 85 * 0.85;
            break;
            case 286:
                $pages = 86 * 0.85;
            break;
            case 287:
                $pages = 87 * 0.85;
            break;
            case 288:
                $pages = 88 * 0.85;
            break;
            case 289:
                $pages = 89 * 0.85;
            break;
            case 290:
                $pages = 90 * 0.85;
            break;
            case 291:
                $pages = 91 * 0.85;
            break;
            case 292:
                $pages = 92 * 0.85;
            break;
            case 293:
                $pages = 93 * 0.85;
            break;
            case 294:
                $pages = 94 * 0.85;
            break;
            case 295:
                $pages = 95 * 0.85;
            break;
            case 296:
                $pages = 96 * 0.85;
            break;
            case 297:
                $pages = 97 * 0.85;
            break;
            case 298:
                $pages = 98 * 0.85;
            break;
            case 299:
                $pages = 99 * 0.85;
            break;
            case 300:
                $pages = 100 * 0.85;
            break;
            default:
                $pages = 1;
        }

        return $pages;
    }
}
